/*Drop Area*/
window.onload=function(){
    const dropZone = document.querySelector('#drop-zone');

    dropZone.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.classList.add('drop-zone--over');
    });
    
    dropZone.addEventListener('dragleave', e => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone--over');
    });
    
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone--over');
        const file = e.dataTransfer.files[0];
        const input = dropZone.querySelector("#csvData");
        input.files = e.dataTransfer.files;
        const prompt = dropZone.querySelector('#drop-zone__prompt');
        prompt.textContent = file.name;
    });
    
    const fileInput = document.getElementById('csvData');
    const fakeButton = document.querySelector('#drop-zone__label');
    
    fakeButton.addEventListener('click', e => {
        e.preventDefault();
        fileInput.click();
    });
    
    fileInput.addEventListener('change', e => {
        const fileName = e.target.files[0].name;
        const prompt = dropZone.querySelector('#drop-zone__prompt');
        prompt.textContent = fileName;
    });
    
}
/*------------*/


/*Accordion*/
document.querySelector('.accordion-toggle').addEventListener('click', function() {
    var accordionContent = document.querySelector('.accordion-content');
    accordionContent.style.display = accordionContent.style.display === 'block' ? 'none' : 'block';
});
/*------------*/
