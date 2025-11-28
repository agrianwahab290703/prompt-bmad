@extends('layouts.app')

@section('title', 'BMAD Generator - Preview')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl p-8 mb-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-eye text-blue-600"></i>
                    Preview: {{ $data['project_name'] ?? 'Generated Project' }}
                </h1>
                <p class="text-gray-600 mt-2">{{ $data['description'] ?? 'No description' }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('bmad.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
                <a href="{{ route('bmad.download') }}" class="bg-gradient-to-r from-green-600 to-teal-700 text-white px-6 py-2 rounded-lg hover:from-green-700 hover:to-teal-800 transition shadow-lg">
                    <i class="fas fa-download mr-2"></i>Download ZIP
                </a>
            </div>
        </div>

        @if(isset($data['tech_stack']) && is_array($data['tech_stack']))
        <div class="mb-6">
            <h3 class="font-semibold text-gray-700 mb-2">
                <i class="fas fa-layer-group mr-1"></i>Tech Stack:
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach($data['tech_stack'] as $tech)
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- File Tree -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-xl p-6 sticky top-4">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-folder-tree mr-2"></i>File Structure
                </h2>
                <div class="file-tree text-sm">
                    @if(isset($data['files']) && is_array($data['files']))
                        @php
                            $fileTree = [];
                            foreach ($data['files'] as $index => $file) {
                                $fileTree[$index] = $file['path'];
                            }
                            sort($fileTree);
                        @endphp
                        
                        @foreach($data['files'] as $index => $file)
                            <div class="file-item" onclick="showFile({{ $index }})" id="file-item-{{ $index }}">
                                <i class="fas fa-file-code text-blue-500 mr-1"></i>
                                {{ $file['path'] }}
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No files generated</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- File Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-code mr-2"></i>File Content
                </h2>
                
                @if(isset($data['files']) && is_array($data['files']))
                    @foreach($data['files'] as $index => $file)
                        <div class="file-content {{ $index === 0 ? '' : 'hidden' }}" id="file-content-{{ $index }}">
                            <div class="bg-gray-100 px-4 py-2 rounded-t-lg border-b-2 border-blue-500">
                                <div class="flex justify-between items-center">
                                    <span class="font-mono text-sm font-semibold">{{ $file['path'] }}</span>
                                    <button onclick="copyContent({{ $index }})" class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-copy mr-1"></i>Copy
                                    </button>
                                </div>
                                @if(isset($file['description']))
                                    <p class="text-xs text-gray-600 mt-1">{{ $file['description'] }}</p>
                                @endif
                            </div>
                            <div class="code-block">
                                <code id="code-{{ $index }}">{{ $file['content'] ?? 'No content' }}</code>
                            </div>
                        </div>
                    @endforeach
                @elseif(isset($data['raw_response']))
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <p class="text-yellow-800">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            AI response could not be parsed as structured data. Raw response:
                        </p>
                    </div>
                    <div class="code-block">
                        <code>{{ $data['raw_response'] }}</code>
                    </div>
                @else
                    <div class="bg-gray-100 rounded-lg p-8 text-center">
                        <i class="fas fa-file-circle-question text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-500">Select a file to view its content</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showFile(index) {
        // Hide all file contents
        document.querySelectorAll('.file-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Remove active class from all file items
        document.querySelectorAll('.file-item').forEach(el => {
            el.classList.remove('active');
        });
        
        // Show selected file content
        document.getElementById('file-content-' + index).classList.remove('hidden');
        
        // Add active class to selected file item
        document.getElementById('file-item-' + index).classList.add('active');
    }
    
    function copyContent(index) {
        const code = document.getElementById('code-' + index).textContent;
        navigator.clipboard.writeText(code).then(() => {
            // Show success message
            alert('Content copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    }
    
    // Activate first file by default
    if (document.getElementById('file-item-0')) {
        showFile(0);
    }
</script>
@endpush
@endsection
