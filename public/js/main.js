function handleButtonLink(e) {
    e.preventDefault();
    e.stopPropagation();

    window.location.href = e.target.dataset.href;
}
