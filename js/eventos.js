document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('.event-image');
    const expandedImage = document.createElement('div');
    expandedImage.classList.add('expanded-image');
    document.body.appendChild(expandedImage);

    images.forEach(image => {
        image.addEventListener('click', () => {
            const img = document.createElement('img');
            img.src = image.src;
            expandedImage.innerHTML = '';
            expandedImage.appendChild(img);
            expandedImage.style.display = 'flex';
        });
    });

    expandedImage.addEventListener('click', () => {
        expandedImage.style.display = 'none';
    });
});
