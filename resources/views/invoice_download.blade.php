<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Download</title>
</head>
<body>
    <script>
        // Function to trigger the PDF download
        function downloadPDF() {
            window.location.href = "{{ $pdfPath }}";
        }

        // Function to redirect to home after download
        function redirectToHome() {
            setTimeout(function() {
                window.location.href = "{{ route('home') }}";
            }, 1000); // Adjust the delay as needed
        }

        // Trigger the download and redirect
        downloadPDF();
        redirectToHome();
    </script>
</body>
</html>
