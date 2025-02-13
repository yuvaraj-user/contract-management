<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge Word Documents</title>
</head>
<body>

<input type="file" id="file1" />
<input type="file" id="file2" />
<button onclick="mergeDocuments()">Merge Documents</button>

<!-- Load PizZip from CDN -->
<script src="https://cdn.jsdelivr.net/npm/pizzip@3.0.3/dist/pizzip.min.js"></script>

<!-- Load Docxtemplater from CDN -->
<script src="https://cdn.jsdelivr.net/npm/docxtemplater@3.19.0/build/docxtemplater.min.js"></script>

<script>
  function mergeDocuments() {
    const file1Input = document.getElementById('file1');
    const file2Input = document.getElementById('file2');

    if (file1Input.files.length > 0 && file2Input.files.length > 0) {
      const file1 = file1Input.files[0];
      const file2 = file2Input.files[0];

      // Read the files as ArrayBuffer
      const reader1 = new FileReader();
      reader1.onload = function(e) {
        const content1 = e.target.result;

        const reader2 = new FileReader();
        reader2.onload = function(e) {
          const content2 = e.target.result;

          // Merge content here
          const mergedContent = mergeDocxContent(content1, content2);

          // Generate the new merged .docx file
          const mergedDoc = new PizZip(mergedContent);
          const doc = new Docxtemplater(mergedDoc);

          const output = doc.getZip().generate({ type: 'blob' });

          // Trigger file download
          const downloadLink = document.createElement('a');
          downloadLink.href = URL.createObjectURL(output);
          downloadLink.download = 'merged_document.docx';
          downloadLink.click();
        };

        reader2.readAsArrayBuffer(file2);
      };

      reader1.readAsArrayBuffer(file1);
    } else {
      alert('Please select both files');
    }
  }

  function mergeDocxContent(content1, content2) {
    // Use PizZip to unzip the content of both files
    const zip1 = new PizZip(content1);
    const zip2 = new PizZip(content2);

    // Extract document.xml content from both files
    const xml1 = zip1.file("word/document.xml").asText();
    const xml2 = zip2.file("word/document.xml").asText();

    // Merge both XMLs (simple concatenation for this example)
    const mergedXml = xml1 + xml2; // This is very basic, you may need to handle more complex merging logic here

    // Create a new Zip with merged content
    zip1.file("word/document.xml", mergedXml);
    return zip1.generate({ type: "nodebuffer" });
  }
</script>

</body>
</html>
