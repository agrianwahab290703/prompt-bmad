@extends('layouts.app')

@section('title', 'BMAD Generator - Generate Project Structure')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl p-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                <i class="fas fa-magic text-blue-600"></i>
                BMAD Generator
            </h1>
            <p class="text-gray-600 text-lg">Break My App Down - AI-Powered Project Structure Generator</p>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Apa itu BMAD?</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>BMAD (Break My App Down) adalah teknik untuk memecah aplikasi menjadi komponen-komponen kecil dan terstruktur. Dengan AI, kami akan menganalisis kebutuhan Anda dan menghasilkan struktur file yang lengkap dan siap pakai.</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('bmad.generate') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="prompt" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-pencil-alt mr-1"></i>
                    Deskripsikan Aplikasi Anda
                </label>
                <textarea 
                    name="prompt" 
                    id="prompt" 
                    rows="10" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="Contoh:&#10;&#10;Buatkan saya aplikasi e-commerce sederhana dengan fitur:&#10;- User authentication (login, register)&#10;- Product catalog dengan kategori&#10;- Shopping cart&#10;- Checkout process&#10;- Admin panel untuk manage products&#10;&#10;Gunakan Node.js, Express, dan MongoDB"
                    required
                >{{ old('prompt') }}</textarea>
                @error('prompt')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-4">
                <h4 class="font-semibold text-gray-800 mb-2">
                    <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                    Tips untuk hasil terbaik:
                </h4>
                <ul class="text-sm text-gray-700 space-y-1 ml-5 list-disc">
                    <li>Jelaskan fitur-fitur utama yang diinginkan</li>
                    <li>Sebutkan teknologi/framework yang ingin digunakan</li>
                    <li>Berikan detail tentang struktur database jika ada</li>
                    <li>Jelaskan user roles atau permissions jika diperlukan</li>
                </ul>
            </div>

            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:from-blue-700 hover:to-indigo-800 transition duration-200 shadow-lg flex items-center"
                >
                    <i class="fas fa-cogs mr-2"></i>
                    Generate BMAD Structure
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 grid md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-blue-600 text-4xl mb-3">
                <i class="fas fa-brain"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">AI-Powered</h3>
            <p class="text-gray-600 text-sm">Menggunakan Z.AI dengan model glm-4.6 untuk analisis cerdas</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-green-600 text-4xl mb-3">
                <i class="fas fa-folder-tree"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">Struktur Lengkap</h3>
            <p class="text-gray-600 text-sm">Generate file struktur yang terorganisir dengan baik</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-purple-600 text-4xl mb-3">
                <i class="fas fa-download"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">Download Langsung</h3>
            <p class="text-gray-600 text-sm">Download project Anda dalam format ZIP</p>
        </div>
    </div>
</div>
@endsection
