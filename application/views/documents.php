<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 800px; /* Increased width for the container */
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px; /* Increased padding for more spacious design */
        }

        .file-list {
            margin-top: 20px;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
        }

        .file-item .file-name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .file-item button {
            border: none;
            background-color: transparent;
            color: #dc3545;
            cursor: pointer;
        }

        .file-item button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary mb-4">Upload Your Documents</h2>

        <!-- File Upload Form -->
        <form id="uploadForm">
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Select File:</label>
                <input type="file" class="form-control" id="fileUpload" accept=".pdf,.docx,.png,.jpg,.jpeg" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>

        <!-- Uploaded Files List -->
        <div class="file-list" id="fileList">
            <h4 class="text-secondary mt-4">Uploaded Files:</h4>
            <div id="fileContainer" class="mt-3">
                <!-- Uploaded file items will appear here -->
            </div>
        </div>
    </div>

    <script>
        // Handle form submission
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get the file input element
            const fileInput = document.getElementById('fileUpload');
            const file = fileInput.files[0];

            if (file) {
                // Display the uploaded file in the list
                const fileContainer = document.getElementById('fileContainer');
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <span class="file-name">${file.name}</span>
                    <button class="delete-file">Remove</button>
                `;

                // Add event listener to the remove button
                fileItem.querySelector('.delete-file').addEventListener('click', function() {
                    fileContainer.removeChild(fileItem);
                });

                // Append the file item to the container
                fileContainer.appendChild(fileItem);

                // Clear the file input field
                fileInput.value = '';
            } else {
                alert('Please select a file to upload.');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
