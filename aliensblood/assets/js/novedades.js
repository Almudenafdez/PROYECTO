document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalAuthor = document.getElementById('modalAuthor');
    const closeBtn = modal.querySelector('.close-btn');
    const prevBtn = document.getElementById('modalPrevBtn');
    const nextBtn = document.getElementById('modalNextBtn');
    const items = document.querySelectorAll('.design-item');

    let currentIndex = -1;

    function openModal(index) {
        if (index < 0 || index >= items.length) return;
        currentIndex = index;
        const item = items[index];
        modalImage.src = item.getAttribute('data-src');
        modalImage.alt = item.getAttribute('data-title');
        modalTitle.textContent = item.getAttribute('data-title');
        modalAuthor.textContent = "Autor: " + item.getAttribute('data-author');
        modal.classList.add('active');
        modal.focus();
    }

    function closeModal() {
        modal.classList.remove('active');
        modalImage.src = '';
        currentIndex = -1;
    }

    function showPrev() {
        if (currentIndex === -1) return;
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = items.length - 1;
        openModal(newIndex);
    }

    function showNext() {
        if (currentIndex === -1) return;
        let newIndex = currentIndex + 1;
        if (newIndex >= items.length) newIndex = 0;
        openModal(newIndex);
    }

    items.forEach((item, i) => {
        item.addEventListener('click', () => openModal(i));
        item.addEventListener('keypress', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openModal(i);
            }
        });
    });

    closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', e => {
        if (e.target === modal) closeModal();
    });

    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);

    document.addEventListener('keydown', e => {
        if (!modal.classList.contains('active')) return;
        if (e.key === 'Escape') closeModal();
        if (e.key === 'ArrowLeft') showPrev();
        if (e.key === 'ArrowRight') showNext();
    });
});