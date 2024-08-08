import { ref } from 'vue';

const darkMode = ref(localStorage.getItem('darkMode') === 'true');

const toggleDarkMode = () => {
  darkMode.value = !darkMode.value;
  localStorage.setItem('darkMode', darkMode.value);
  document.documentElement.classList.toggle('dark', darkMode.value);
};

export { darkMode, toggleDarkMode };
