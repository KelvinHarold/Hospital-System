<x-report-layout>
    <div class="max-w-4xl mx-auto p-8">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="flex items-center space-x-4 mb-6">
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-file-medical text-2xl text-orange-600"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Submit New Report</h2>
                    <p class="text-gray-600">Create a detailed report with relevant information</p>
                </div>
            </div>

            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Category Selection -->
                <div class="bg-orange-50 p-6 rounded-lg border border-orange-100">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-tags text-orange-500"></i>
                        <span>Report Category</span>
                    </label>
                    <select name="report_type" required 
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                        <option value="">Select a category</option>
                        @foreach ($enumValues as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description Field -->
                <div class="bg-orange-50 p-6 rounded-lg border border-orange-100">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left text-orange-500"></i>
                        <span>Description</span>
                    </label>
                    <textarea 
                        name="description" 
                        required 
                        rows="5"
                        placeholder="Enter detailed description of your report..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
                    ></textarea>
                </div>

                <!-- File Upload -->
                <div class="bg-orange-50 p-6 rounded-lg border border-orange-100">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-paperclip text-orange-500"></i>
                        <span>Attachments</span>
                    </label>
                    <div class="mt-2">
                        <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-orange-500 transition-colors duration-200">
                            <div class="space-y-2 text-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                <div class="text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PDF, DOC, DOCX, PNG, JPG up to 10MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button Section -->
                <div class="flex items-center justify-end space-x-4">
                    <button type="button" 
                            onclick="window.history.back()"
                            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Submit Report
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-orange-200 p-2 rounded-full">
                    <i class="fas fa-lightbulb text-xl text-orange-600"></i>
            </div>
                <h3 class="text-lg font-semibold text-orange-900">Tips for submitting a report</h3>
        </div>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-center space-x-3 bg-white p-3 rounded-lg shadow-sm">
                    <i class="fas fa-check-circle text-orange-500"></i>
                    <span>Be specific and detailed in your description</span>
                </li>
                <li class="flex items-center space-x-3 bg-white p-3 rounded-lg shadow-sm">
                    <i class="fas fa-check-circle text-orange-500"></i>
                    <span>Include relevant dates and times</span>
                </li>
                <li class="flex items-center space-x-3 bg-white p-3 rounded-lg shadow-sm">
                    <i class="fas fa-check-circle text-orange-500"></i>
                    <span>Attach supporting documents when available</span>
                </li>
                <li class="flex items-center space-x-3 bg-white p-3 rounded-lg shadow-sm">
                    <i class="fas fa-check-circle text-orange-500"></i>
                    <span>Review your report before submission</span>
                </li>
            </ul>
    </div>

        <!-- Progress Indicator -->
        <div class="mt-8 bg-white rounded-lg p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold text-gray-700">Report Submission Progress</h4>
                <span class="text-orange-500">Step 1 of 2</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-orange-500 h-2 rounded-full w-1/2"></div>
            </div>
        </div>
    </div>

    <!-- Add Font Awesome CDN in the layout if not already present -->
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom File Upload Styles */
        .file-upload-hover {
            border-color: #f97316 !important;
            background-color: #fff7ed;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // File upload preview and drag-drop functionality
        const dropZone = document.querySelector('.border-dashed');
        const fileInput = document.getElementById('file-upload');

        // Drag and drop handlers
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('file-upload-hover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('file-upload-hover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('file-upload-hover');
            fileInput.files = e.dataTransfer.files;
            updateFileInfo(e.dataTransfer.files[0]);
        });

        // File selection handler
        fileInput.addEventListener('change', (e) => {
            if (e.target.files[0]) {
                updateFileInfo(e.target.files[0]);
            }
        });

        function updateFileInfo(file) {
            const container = dropZone.querySelector('.space-y-2');
            const existingInfo = container.querySelector('.file-info');
            if (existingInfo) {
                existingInfo.remove();
            }
            const fileInfo = document.createElement('div');
            fileInfo.className = 'file-info text-sm text-orange-600 bg-orange-50 p-2 rounded-md flex items-center justify-center mt-2';
            fileInfo.innerHTML = `
                <i class="fas fa-file mr-2"></i>
                <span>${file.name}</span>
                <button type="button" class="ml-2 text-gray-500 hover:text-red-500" onclick="removeFile()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(fileInfo);
        }

        function removeFile() {
            fileInput.value = '';
            const fileInfo = document.querySelector('.file-info');
            if (fileInfo) {
                fileInfo.remove();
            }
        }
    </script>
    @endpush
</x-report-layout>
