/* Для выпадающей менюшки входа в ЛК */
const toggleBtn = document.querySelector('.toggle-btn')
const toggleBtnIcon = document.querySelector('.toggle-btn i')
const dropDownMenu = document.querySelector('.dropdown-content')

toggleBtn.onclick = function () {
  dropDownMenu.classList.toggle('open')
  const isOpen = dropDownMenu.classList.contains('open')

  toggleBtnIcon.classList = isOpen
    ? 'fa-solid fa-xmark'
    : 'fa-solid fa-bars'
}


// Закрыть выпадающее меню, если пользователь кликает за его пределами
document.addEventListener('click', function (event) {
  if (!toggleBtn.contains(event.target) && !dropDownMenu.contains(event.target)) {
    dropDownMenu.classList.remove('open')
    toggleBtnIcon.classList = 'fa-solid fa-bars'
  }
})

// Для продукта чтоб видеть характеристики
document.addEventListener('DOMContentLoaded', function () {
  const toggleButtons = document.querySelectorAll('.toggle-characteristics');

  toggleButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();

      const characteristics = this.nextElementSibling;

      characteristics.classList.toggle('hidden');

      if (characteristics.classList.contains('hidden')) {
        this.innerHTML = 'Характеристики ▼';
      } else {
        this.innerHTML = 'Характеристики ▲';
      }

      e.stopPropagation();
    });
  });
});

// Появление кнопки для прокрутки страницы вверх

const scrollToTopBtn = document.getElementById('scrollToTopBtn');

window.addEventListener('scroll', function () {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollToTopBtn.style.display = 'block'; // Показываем кнопку
  } else {
    scrollToTopBtn.style.display = 'none'; // Скрываем кнопку
  }
});

if (scrollToTopBtn) {
  scrollToTopBtn.addEventListener('click', function () {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}


// Для копирования ариткула
document.addEventListener('DOMContentLoaded', function () {
  const copyButtons = document.querySelectorAll('.copy-icon-btn');

  copyButtons.forEach(button => {
    button.addEventListener('click', async function () {
      const targetId = this.getAttribute('data-target');
      const textToCopy = document.getElementById(targetId).textContent;
      const icon = this.querySelector('i');

      try {
        await navigator.clipboard.writeText(textToCopy);

        // Меняем иконку на "галочку"
        icon.classList.replace('fa-copy', 'fa-check');
        this.classList.add('copied');

        setTimeout(() => {
          icon.classList.replace('fa-check', 'fa-copy');
          this.classList.remove('copied');
        }, 2000);

      } catch (err) {
        console.error('Ошибка копирования:', err);
        icon.style.color = 'red'; // Ошибка
        setTimeout(() => icon.style.color = '', 2000);
      }
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.querySelector('.toggle-btn');
  const dropdownContent = document.querySelector('.dropdown-content');
  const mainMenuLinks = document.querySelector('.main-menu-links');
  const links = document.querySelectorAll('.links li a');
  const dropdownDivider = document.querySelector('.dropdown-divider');

  function cloneLinksToDropdown() {
    mainMenuLinks.innerHTML = '';

    links.forEach(link => {
      const clone = link.cloneNode(true);
      mainMenuLinks.appendChild(clone);
    });
  }

  function updateMenu() {
    if (window.innerWidth <= 992) {
      cloneLinksToDropdown();
      dropdownDivider.style.display = 'block';
    } else {
      mainMenuLinks.innerHTML = '';
      dropdownDivider.style.display = 'none';
    }
  }

  updateMenu();

  toggleBtn.addEventListener('click', function () {
    dropdownContent.classList.toggle('active');
  });

  document.addEventListener('click', function (event) {
    if (!toggleBtn.contains(event.target) && !dropdownContent.contains(event.target)) {
      dropdownContent.classList.remove('active');
    }
  });

  window.addEventListener('resize', function () {
    updateMenu();
    if (window.innerWidth > 992) {
      dropdownContent.classList.remove('active');
    }
  });
});