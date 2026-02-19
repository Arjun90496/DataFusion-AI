@extends('layouts.layout')

@section('title', 'AI Search')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">AI Search</h1>
        
        <div class="mb-6">
            <div class="relative">
                <input type="text" id="searchQuery" 
                       class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white" 
                       placeholder="Ask me anything... (e.g., 'What's the weather in London?', 'Latest tech news', 'Bitcoin price')">
                <button id="searchBtn" 
                        class="absolute right-2 top-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50">
                    Search
                </button>
            </div>
        </div>

        <div id="loading" class="hidden text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Searching...</p>
        </div>

        <div id="results" class="hidden">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-3">AI Response:</h3>
                <div id="aiResponse" class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap"></div>
            </div>
        </div>

        <div id="error" class="hidden bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
            <p class="text-red-700 dark:text-red-400" id="errorMessage"></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchQuery = document.getElementById('searchQuery');
    const searchBtn = document.getElementById('searchBtn');
    const loading = document.getElementById('loading');
    const results = document.getElementById('results');
    const error = document.getElementById('error');
    const aiResponse = document.getElementById('aiResponse');
    const errorMessage = document.getElementById('errorMessage');

    function performSearch() {
        const query = searchQuery.value.trim();
        if (!query) return;

        // Show loading, hide others
        loading.classList.remove('hidden');
        results.classList.add('hidden');
        error.classList.add('hidden');
        searchBtn.disabled = true;

        fetch('{{ route("ai-search.search") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ query: query })
        })
        .then(response => response.json())
        .then(data => {
            loading.classList.add('hidden');
            searchBtn.disabled = false;

            if (data.success) {
                aiResponse.textContent = data.response;
                results.classList.remove('hidden');
            } else {
                errorMessage.textContent = data.message || 'An error occurred';
                error.classList.remove('hidden');
            }
        })
        .catch(err => {
            loading.classList.add('hidden');
            searchBtn.disabled = false;
            errorMessage.textContent = 'Network error. Please try again.';
            error.classList.remove('hidden');
        });
    }

    searchBtn.addEventListener('click', performSearch);
    searchQuery.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') performSearch();
    });
});
</script>
@endsection