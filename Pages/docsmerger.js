console.log('hi');
// console.log('hi');
const fs = require('fs');

const DocxMerger = require('docx-merger');

const files = [fs.readFileSync('uploads/Template.docx'), fs.readFileSync('uploads/Schedule2.docx')];

const docxMerger = new DocxMerger({}, files);

docxMerger.save('nodebuffer', (data) => {

 fs.writeFileSync('uploads/docsmerge_word.docx', data);

});



// const fs = require('fs');
// const DocxMerger = require('docx-merger');

// // Get file paths from command line arguments
// // const file1 = process.argv[2];
// // const file2 = process.argv[3];

// const files = [fs.readFileSync(file1), fs.readFileSync(file2)];

// const docxMerger = new DocxMerger({}, files);

// docxMerger.save('nodebuffer', (data) => {
//   fs.writeFileSync('merged.docx', data);
//   console.log('Merged file saved as merged.docx');
// });
