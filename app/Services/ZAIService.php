<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZAIService
{
    protected $apiKey;
    protected $apiUrl;
    protected $model;
    protected $timeout;

    public function __construct()
    {
        $this->apiKey = config('zai.api_key');
        $this->apiUrl = config('zai.api_url');
        $this->model = config('zai.model');
        $this->timeout = config('zai.timeout');
    }

    public function generateBMAD($prompt)
    {
        $systemPrompt = "You are an expert software architect specializing in the BMAD (Break My App Down) technique. Your task is to analyze application requirements and break them down into a well-structured file hierarchy with detailed implementation plans.

When given a project description, you should:
1. Analyze the requirements
2. Create a comprehensive file structure
3. Provide detailed content for each file
4. Follow best practices and design patterns
5. Ensure proper separation of concerns

Return the response in JSON format with the following structure:
{
    \"project_name\": \"project-name\",
    \"description\": \"Brief description of the project\",
    \"tech_stack\": [\"technology1\", \"technology2\"],
    \"files\": [
        {
            \"path\": \"relative/path/to/file.ext\",
            \"description\": \"Purpose of this file\",
            \"content\": \"Full content of the file\"
        }
    ]
}";

        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($this->apiUrl . '/chat/completions', [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 4096,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['choices'][0]['message']['content'])) {
                    $content = $data['choices'][0]['message']['content'];
                    
                    // Extract JSON from markdown code blocks if present
                    if (preg_match('/```json\s*(.*?)\s*```/s', $content, $matches)) {
                        $content = $matches[1];
                    } elseif (preg_match('/```\s*(.*?)\s*```/s', $content, $matches)) {
                        $content = $matches[1];
                    }
                    
                    $jsonData = json_decode($content, true);
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return [
                            'success' => true,
                            'data' => $jsonData
                        ];
                    } else {
                        // If JSON parsing fails, return raw content
                        return [
                            'success' => true,
                            'data' => [
                                'project_name' => 'generated-project',
                                'description' => 'Generated from prompt',
                                'raw_response' => $content
                            ]
                        ];
                    }
                }
            }

            Log::error('Z.AI API Error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'Failed to generate BMAD structure: ' . $response->body()
            ];
        } catch (\Exception $e) {
            Log::error('Z.AI API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => 'Exception: ' . $e->getMessage()
            ];
        }
    }

    public function refineFile($fileDescription, $currentContent = '')
    {
        $prompt = "Please generate or improve the following file:\n\n";
        $prompt .= "Description: {$fileDescription}\n\n";
        
        if ($currentContent) {
            $prompt .= "Current content:\n{$currentContent}\n\n";
            $prompt .= "Please improve or complete this implementation.";
        } else {
            $prompt .= "Please provide a complete implementation.";
        }

        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($this->apiUrl . '/chat/completions', [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 2048,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['choices'][0]['message']['content'])) {
                    return [
                        'success' => true,
                        'content' => $data['choices'][0]['message']['content']
                    ];
                }
            }

            return [
                'success' => false,
                'error' => 'Failed to refine file: ' . $response->body()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Exception: ' . $e->getMessage()
            ];
        }
    }
}
