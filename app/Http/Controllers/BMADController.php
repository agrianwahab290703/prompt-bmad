<?php

namespace App\Http\Controllers;

use App\Services\ZAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class BMADController extends Controller
{
    protected $zaiService;

    public function __construct(ZAIService $zaiService)
    {
        $this->zaiService = $zaiService;
    }

    public function index()
    {
        return view('bmad.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|min:10',
        ]);

        $prompt = $request->input('prompt');
        
        // Generate BMAD structure using Z.AI
        $result = $this->zaiService->generateBMAD($prompt);

        if (!$result['success']) {
            return back()->with('error', $result['error']);
        }

        $data = $result['data'];
        
        // Store the generated structure in session for preview
        session(['bmad_data' => $data]);

        return redirect()->route('bmad.preview');
    }

    public function preview()
    {
        $data = session('bmad_data');

        if (!$data) {
            return redirect()->route('bmad.index')->with('error', 'No BMAD data found. Please generate first.');
        }

        return view('bmad.preview', compact('data'));
    }

    public function download()
    {
        $data = session('bmad_data');

        if (!$data) {
            return redirect()->route('bmad.index')->with('error', 'No BMAD data found. Please generate first.');
        }

        // Create a unique directory for this generation
        $projectSlug = Str::slug($data['project_name'] ?? 'project');
        $timestamp = now()->format('YmdHis');
        $directoryName = "{$projectSlug}-{$timestamp}";
        $tempPath = storage_path("app/temp/{$directoryName}");

        // Create directory if it doesn't exist
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        // Create files
        if (isset($data['files']) && is_array($data['files'])) {
            foreach ($data['files'] as $file) {
                $filePath = $tempPath . '/' . $file['path'];
                $fileDir = dirname($filePath);

                // Create directory structure
                if (!file_exists($fileDir)) {
                    mkdir($fileDir, 0755, true);
                }

                // Write file content
                file_put_contents($filePath, $file['content'] ?? '');
            }
        }

        // Create README.md
        $readmeContent = "# {$data['project_name']}\n\n";
        $readmeContent .= "{$data['description']}\n\n";
        
        if (isset($data['tech_stack'])) {
            $readmeContent .= "## Tech Stack\n\n";
            foreach ($data['tech_stack'] as $tech) {
                $readmeContent .= "- {$tech}\n";
            }
            $readmeContent .= "\n";
        }

        $readmeContent .= "## Files Generated\n\n";
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $readmeContent .= "- `{$file['path']}` - {$file['description']}\n";
            }
        }

        $readmeContent .= "\n---\nGenerated using BMAD technique with Z.AI (glm-4.6)\n";
        file_put_contents($tempPath . '/README.md', $readmeContent);

        // Create ZIP archive
        $zipPath = storage_path("app/temp/{$directoryName}.zip");
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($tempPath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempPath) + 1);
                    $zip->addFile($filePath, $directoryName . '/' . $relativePath);
                }
            }

            $zip->close();

            // Clean up temp directory
            $this->deleteDirectory($tempPath);

            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Failed to create ZIP archive');
    }

    public function refine(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string',
            'description' => 'required|string',
            'current_content' => 'nullable|string',
        ]);

        $result = $this->zaiService->refineFile(
            $request->input('description'),
            $request->input('current_content', '')
        );

        return response()->json($result);
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }
}
