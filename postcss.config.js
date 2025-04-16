import tailwindcss from '@tailwindcss/postcss';
import autoprefixer from 'autoprefixer';

export default {
    plugins: [
        tailwindcss(),  // Tailwind CSS plugin
        autoprefixer(), // Autoprefixer for vendor prefixes
    ],
};
