document.addEventListener('DOMContentLoaded', function () {
  const toggleViewButton = document.getElementById('toggleViewButton');
  const excludeButtons = document.querySelectorAll('.exclude-button');
  const recoverImagesButton = document.getElementById('recoverImagesButton');
  const sortSelect = document.getElementById('sortSelect');
  const searchInput = document.getElementById('searchInput');
  const listView = document.getElementById('listView');
  const gridView = document.getElementById('gridView');
  let isListView = false;

  const excludedImages =
    JSON.parse(localStorage.getItem('excludedImages')) || [];
  console.log(excludedImages);

  toggleViewButton.addEventListener('click', function () {
    updateToggleIcon();
    toggleView();
  });

  excludeButtons.forEach((button) => {
    button.addEventListener('click', function () {
      const imageId = this.closest('.image-item').getAttribute('data-id');
      excludeImage(imageId);
    });
  });

  recoverImagesButton.addEventListener('click', function () {
    recoverExcludedImages();
  });

  sortSelect.addEventListener('input', sortImages);
  searchInput.addEventListener('input', searchImages);

  function updateToggleIcon() {
    const toggleIcon = document.getElementById('toggleIcon');
    toggleIcon.className = isListView ? 'fas fa-th' : 'fas fa-list';
  }

  function toggleView() {
    isListView = !isListView;
    updateView();
  }

  function updateView() {
    listView.style.display = isListView ? 'inline-block' : 'none';
    gridView.style.display = isListView ? 'none' : 'flex';
  }

  function sortImages() {
    const imageContainer = isListView ? listView : gridView;
    const images = getSortedImages(imageContainer);
    console.log(images);
    clearContainer(imageContainer);

    if (isListView) {
      renderListView(imageContainer, images);
    } else {
      images.forEach((image) => {
        console.log(image);
        imageContainer.appendChild(image);
      });
    }
  }

  function getSortedImages(container) {
    const images = Array.from(container.querySelectorAll('.image-item'));
    const sortCriteria = sortSelect.value;
    console.log(images);
    return images.sort((a, b) => {
      const aTitle = a.getAttribute('data-title');
      const bTitle = b.getAttribute('data-title');
      const aDate = new Date(a.getAttribute('data-date')).getTime();
      const bDate = new Date(b.getAttribute('data-date')).getTime();
      let comparison;

      switch (sortCriteria) {
        case 'titleAsc':
          comparison = aTitle.localeCompare(bTitle);
          break;
        case 'titleDesc':
          comparison = bTitle.localeCompare(aTitle);
          break;
        case 'dateAsc':
          comparison = aDate - bDate;
          break;
        case 'dateDesc':
          comparison = bDate - aDate;
          break;
        default:
          comparison = 0;
          break;
      }

      return comparison;
    });
  }

  function clearContainer(container) {
    container.innerHTML = '';
  }

  function renderListView(container, images) {
    const table = document.createElement('table');
    table.classList.add('table');

    const thead = document.createElement('thead');
    thead.innerHTML = `
      <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Date</th>
        <th></th>
      </tr>
    `;
    table.appendChild(thead);

    const tbody = document.createElement('tbody');
    images.forEach((image) => {
      tbody.appendChild(image);
    });
    table.appendChild(tbody);

    container.appendChild(table);
  }

  function searchImages() {
    const imageContainer = isListView ? listView : gridView;
    const images = Array.from(imageContainer.querySelectorAll('.image-item'));
    const searchTerm = searchInput.value.toLowerCase();

    images.forEach((image) => {
      const title = image.getAttribute('data-title').toLowerCase();
      const isVisible = title.includes(searchTerm);
      image.style.display = isVisible ? '' : 'none';
    });
  }

  function excludeImage(imageId) {
    excludedImages.push(imageId);
    localStorage.setItem('excludedImages', JSON.stringify(excludedImages));
    updateExcludedImages();
  }

  function recoverExcludedImages() {
    excludedImages.length = 0;
    localStorage.removeItem('excludedImages');
    updateExcludedImages();
  }

  function updateExcludedImages() {
    document.querySelectorAll('.image-item').forEach((item) => {
      const imageId = item.getAttribute('data-id');
      item.style.display = excludedImages.includes(imageId) ? 'none' : '';
    });
  }

  updateExcludedImages();
});
