document.addEventListener('DOMContentLoaded', function() {
    const readMoreLinks = document.querySelectorAll('.read-more');
  
    readMoreLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const descriptionDiv = this.parentNode.previousElementSibling; 
        descriptionDiv.classList.toggle('expanded');
        this.textContent = descriptionDiv.classList.contains('expanded') ? 'Read Less' : 'Read More';
      });
    });
  });