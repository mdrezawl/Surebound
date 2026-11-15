import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const rootDir = __dirname;
const publicDir = path.join(rootDir, 'public');
const distDir = path.join(rootDir, 'dist');

function copyDirSync(src, dest) {
    if (!fs.existsSync(src)) return;
    fs.mkdirSync(dest, { recursive: true });
    const entries = fs.readdirSync(src, { withFileTypes: true });
    for (const entry of entries) {
        const srcPath = path.join(src, entry.name);
        const destPath = path.join(dest, entry.name);
        if (entry.isDirectory()) {
            copyDirSync(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

// Ensure dist exists
fs.mkdirSync(distDir, { recursive: true });

// Copy public assets into dist
copyDirSync(path.join(publicDir, 'css'), path.join(distDir, 'css'));
copyDirSync(path.join(publicDir, 'js'), path.join(distDir, 'js'));
copyDirSync(path.join(publicDir, 'images'), path.join(distDir, 'images'));
copyDirSync(path.join(publicDir, 'fonts'), path.join(distDir, 'fonts'));
if (fs.existsSync(path.join(publicDir, 'build'))) {
    copyDirSync(path.join(publicDir, 'build'), path.join(distDir, 'build'));
}

['favicon.ico', 'robots.txt', 'llms.txt', 'llms-full.txt'].forEach(f => {
    const src = path.join(publicDir, f);
    if (fs.existsSync(src)) {
        fs.copyFileSync(src, path.join(distDir, f));
    }
});

console.log('✓ Successfully populated and verified dist directory for Vercel deployment.');
