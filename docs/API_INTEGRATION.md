# Z.AI API Integration Guide

Dokumentasi ini menjelaskan bagaimana BMAD Generator terintegrasi dengan Z.AI API.

## 🔧 Konfigurasi

### Environment Variables

Tambahkan konfigurasi berikut ke file `.env`:

```env
ZAI_API_KEY=your-api-key-here
ZAI_API_URL=https://api.z.ai/v1
ZAI_MODEL=glm-4.6
ZAI_TIMEOUT=60
```

### Konfigurasi File

File konfigurasi terletak di `config/zai.php`:

```php
return [
    'api_key' => env('ZAI_API_KEY', ''),
    'api_url' => env('ZAI_API_URL', 'https://api.z.ai/v1'),
    'model' => env('ZAI_MODEL', 'glm-4.6'),
    'timeout' => env('ZAI_TIMEOUT', 60),
];
```

## 📡 API Service

### ZAIService Class

Service utama untuk komunikasi dengan Z.AI API terletak di `app/Services/ZAIService.php`.

#### Methods

##### `generateBMAD($prompt)`

Generate struktur BMAD berdasarkan prompt pengguna.

**Parameters:**
- `$prompt` (string): Deskripsi aplikasi yang ingin di-generate

**Returns:**
```php
[
    'success' => true,
    'data' => [
        'project_name' => 'nama-project',
        'description' => 'Deskripsi project',
        'tech_stack' => ['tech1', 'tech2'],
        'files' => [
            [
                'path' => 'path/to/file.ext',
                'description' => 'Deskripsi file',
                'content' => 'Isi file'
            ]
        ]
    ]
]
```

**Error Response:**
```php
[
    'success' => false,
    'error' => 'Error message'
]
```

##### `refineFile($fileDescription, $currentContent = '')`

Memperbaiki atau melengkapi isi file.

**Parameters:**
- `$fileDescription` (string): Deskripsi file yang ingin di-refine
- `$currentContent` (string, optional): Konten file saat ini

**Returns:**
```php
[
    'success' => true,
    'content' => 'Konten file yang sudah di-refine'
]
```

## 🔐 Authentication

Z.AI API menggunakan Bearer token authentication. Token dikirim di header request:

```
Authorization: Bearer YOUR_API_KEY
```

## 📝 Request Format

### Chat Completion Request

```json
{
    "model": "glm-4.6",
    "messages": [
        {
            "role": "system",
            "content": "System prompt..."
        },
        {
            "role": "user",
            "content": "User prompt..."
        }
    ],
    "temperature": 0.7,
    "max_tokens": 4096
}
```

### Parameters

- **model**: Model yang digunakan (glm-4.6)
- **messages**: Array of message objects
  - **role**: "system" atau "user"
  - **content**: Isi pesan
- **temperature**: 0.0 - 1.0 (kreativitas response)
- **max_tokens**: Maksimum token dalam response

## 📊 Response Format

### Success Response

```json
{
    "choices": [
        {
            "message": {
                "role": "assistant",
                "content": "Response content..."
            }
        }
    ],
    "usage": {
        "prompt_tokens": 100,
        "completion_tokens": 200,
        "total_tokens": 300
    }
}
```

## 🎯 System Prompt

System prompt yang digunakan untuk generate BMAD:

```
You are an expert software architect specializing in the BMAD (Break My App Down) technique. 
Your task is to analyze application requirements and break them down into a well-structured 
file hierarchy with detailed implementation plans.

When given a project description, you should:
1. Analyze the requirements
2. Create a comprehensive file structure
3. Provide detailed content for each file
4. Follow best practices and design patterns
5. Ensure proper separation of concerns

Return the response in JSON format with the following structure:
{
    "project_name": "project-name",
    "description": "Brief description of the project",
    "tech_stack": ["technology1", "technology2"],
    "files": [
        {
            "path": "relative/path/to/file.ext",
            "description": "Purpose of this file",
            "content": "Full content of the file"
        }
    ]
}
```

## ⚠️ Error Handling

Service menangani berbagai error:

1. **API Error**: Response status bukan 200
2. **Network Error**: Timeout atau connection error
3. **JSON Parse Error**: Response tidak valid JSON
4. **Missing Data**: Response tidak memiliki struktur yang diharapkan

Semua error di-log ke `storage/logs/laravel.log`.

## 🔄 Rate Limiting

Pastikan untuk mengimplementasikan rate limiting di controller untuk menghindari excessive API calls.

## 📈 Best Practices

1. **Cache Results**: Cache hasil generation untuk menghindari duplicate calls
2. **Validate Input**: Validasi prompt sebelum mengirim ke API
3. **Handle Timeouts**: Set timeout yang reasonable (default: 60 detik)
4. **Error Logging**: Log semua error untuk debugging
5. **Retry Logic**: Implementasikan retry logic untuk transient errors

## 🧪 Testing

Contoh testing dengan API mock:

```php
// Test BMAD generation
public function test_generate_bmad()
{
    Http::fake([
        'api.z.ai/*' => Http::response([
            'choices' => [
                [
                    'message' => [
                        'content' => json_encode([
                            'project_name' => 'test-project',
                            'files' => []
                        ])
                    ]
                ]
            ]
        ], 200)
    ]);

    $service = new ZAIService();
    $result = $service->generateBMAD('test prompt');

    $this->assertTrue($result['success']);
}
```

## 📚 Resources

- [Z.AI Documentation](https://z.ai/docs)
- [glm-4.6 Model Info](https://z.ai/models/glm-4.6)
- [Laravel HTTP Client](https://laravel.com/docs/http-client)
