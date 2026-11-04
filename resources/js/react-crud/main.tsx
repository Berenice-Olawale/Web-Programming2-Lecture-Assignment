import { createRoot } from 'react-dom/client';
import NotebookCrud from './NotebookCrud';

const container = document.getElementById('react-root');

if (container) {
    createRoot(container).render(<NotebookCrud />);
}