import axios from 'axios';
import { useEffect, useState } from 'react';
import type { ChangeEvent, FormEvent } from 'react';

type Notebook = {
    id: number;
    manufacturer: string;
    type: string;
    display: string;
    memory: number;
    harddisk: number;
    videocontroller: string;
    price: number;
    processorid: number;
    opsystemid: number;
    pieces: number;
    processor_manufacturer: string | null;
    processor_type: string | null;
    operating_system: string | null;
};

type Processor = {
    id: number;
    manufacturer: string;
    type: string;
};

type OperatingSystem = {
    id: number;
    name: string;
};

type FormState = {
    manufacturer: string;
    type: string;
    display: string;
    memory: string;
    harddisk: string;
    videocontroller: string;
    price: string;
    processorid: string;
    opsystemid: string;
    pieces: string;
};

type FormErrors = Partial<Record<keyof FormState, string>>;

const API_URL = '/react-api/notebooks';

const emptyForm: FormState = {
    manufacturer: '',
    type: '',
    display: '',
    memory: '',
    harddisk: '',
    videocontroller: '',
    price: '',
    processorid: '',
    opsystemid: '',
    pieces: '0',
};

const textFields: { name: keyof FormState; label: string; type: string }[] = [
    { name: 'manufacturer', label: 'Manufacturer', type: 'text' },
    { name: 'type', label: 'Model', type: 'text' },
    { name: 'display', label: 'Display (inch)', type: 'text' },
    { name: 'memory', label: 'Memory (MB)', type: 'number' },
    { name: 'harddisk', label: 'Storage (GB)', type: 'number' },
    { name: 'videocontroller', label: 'Video controller', type: 'text' },
    { name: 'price', label: 'Price (Ft)', type: 'number' },
    { name: 'pieces', label: 'Pieces in stock', type: 'number' },
];

export default function NotebookCrud() {
    const [notebooks, setNotebooks] = useState<Notebook[]>([]);
    const [processors, setProcessors] = useState<Processor[]>([]);
    const [operatingSystems, setOperatingSystems] = useState<OperatingSystem[]>([]);
    const [form, setForm] = useState<FormState>(emptyForm);
    const [editingId, setEditingId] = useState<number | null>(null);
    const [errors, setErrors] = useState<FormErrors>({});
    const [message, setMessage] = useState('');

    const loadNotebooks = async () => {
        const response = await axios.get<Notebook[]>(API_URL);
        setNotebooks(response.data);
    };

    useEffect(() => {
        const loadAll = async () => {
            const lookups = await axios.get<{
                processors: Processor[];
                operating_systems: OperatingSystem[];
            }>('/react-api/lookups');
            setProcessors(lookups.data.processors);
            setOperatingSystems(lookups.data.operating_systems);
            await loadNotebooks();
        };

        void loadAll();
    }, []);

    const handleChange = (
        event: ChangeEvent<HTMLInputElement | HTMLSelectElement>,
    ) => {
        setForm({ ...form, [event.target.name]: event.target.value });
    };

    const resetForm = () => {
        setForm(emptyForm);
        setEditingId(null);
        setErrors({});
    };

    const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        setErrors({});

        try {
            if (editingId === null) {
                await axios.post(API_URL, form);
                setMessage('Notebook successfully added.');
            } else {
                await axios.put(`${API_URL}/${editingId}`, form);
                setMessage('Notebook successfully updated.');
            }
            resetForm();
            await loadNotebooks();
        } catch (error) {
            if (axios.isAxiosError(error) && error.response?.status === 422) {
                const apiErrors = error.response.data.errors as Record<string, string[]>;
                const mapped: FormErrors = {};
                for (const key of Object.keys(apiErrors)) {
                    mapped[key as keyof FormState] = apiErrors[key][0];
                }
                setErrors(mapped);
            } else {
                setMessage('Something went wrong. Please try again.');
            }
        }
    };

    const startEdit = (notebook: Notebook) => {
        setEditingId(notebook.id);
        setForm({
            manufacturer: notebook.manufacturer,
            type: notebook.type,
            display: notebook.display,
            memory: String(notebook.memory),
            harddisk: String(notebook.harddisk),
            videocontroller: notebook.videocontroller,
            price: String(notebook.price),
            processorid: String(notebook.processorid),
            opsystemid: String(notebook.opsystemid),
            pieces: String(notebook.pieces),
        });
        setErrors({});
        setMessage('');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    const deleteNotebook = async (notebook: Notebook) => {
        if (!window.confirm(`Are you sure you want to delete ${notebook.manufacturer} ${notebook.type}?`)) {
            return;
        }
        await axios.delete(`${API_URL}/${notebook.id}`);
        setMessage('Notebook successfully deleted.');
        await loadNotebooks();
    };

    return (
        <div>
            {message && <div className="alert-success">{message}</div>}

            <section className="card react-form">
                <h3>{editingId === null ? 'Add notebook' : 'Edit notebook'}</h3>

                <form onSubmit={handleSubmit}>
                    <div className="form-grid">
                        {textFields.map((field) => (
                            <div key={field.name}>
                                <label htmlFor={field.name}>{field.label}</label>
                                <input
                                    id={field.name}
                                    name={field.name}
                                    type={field.type}
                                    value={form[field.name]}
                                    onChange={handleChange}
                                />
                                {errors[field.name] && (
                                    <span className="field-error">{errors[field.name]}</span>
                                )}
                            </div>
                        ))}

                        <div>
                            <label htmlFor="processorid">Processor</label>
                            <select
                                id="processorid"
                                name="processorid"
                                value={form.processorid}
                                onChange={handleChange}
                            >
                                <option value="">-- Choose a processor --</option>
                                {processors.map((processor) => (
                                    <option key={processor.id} value={processor.id}>
                                        {processor.manufacturer} {processor.type}
                                    </option>
                                ))}
                            </select>
                            {errors.processorid && (
                                <span className="field-error">{errors.processorid}</span>
                            )}
                        </div>

                        <div>
                            <label htmlFor="opsystemid">Operating system</label>
                            <select
                                id="opsystemid"
                                name="opsystemid"
                                value={form.opsystemid}
                                onChange={handleChange}
                            >
                                <option value="">-- Choose an operating system --</option>
                                {operatingSystems.map((os) => (
                                    <option key={os.id} value={os.id}>
                                        {os.name}
                                    </option>
                                ))}
                            </select>
                            {errors.opsystemid && (
                                <span className="field-error">{errors.opsystemid}</span>
                            )}
                        </div>
                    </div>

                    <div className="form-actions">
                        <button type="submit" className="btn">
                            {editingId === null ? 'Add notebook' : 'Save changes'}
                        </button>
                        {editingId !== null && (
                            <button type="button" className="btn btn-grey" onClick={resetForm}>
                                Cancel
                            </button>
                        )}
                    </div>
                </form>
            </section>

            <section className="card">
                <p className="record-count">{notebooks.length} records</p>

                <div className="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Manufacturer</th>
                                <th>Model</th>
                                <th>Display</th>
                                <th>Memory (MB)</th>
                                <th>Storage (GB)</th>
                                <th>Processor</th>
                                <th>Operating System</th>
                                <th>Price (Ft)</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {notebooks.map((notebook) => (
                                <tr key={notebook.id}>
                                    <td>{notebook.id}</td>
                                    <td>{notebook.manufacturer}</td>
                                    <td>{notebook.type}</td>
                                    <td>{notebook.display}</td>
                                    <td>{notebook.memory}</td>
                                    <td>{notebook.harddisk}</td>
                                    <td>
                                        {notebook.processor_manufacturer} {notebook.processor_type}
                                    </td>
                                    <td>{notebook.operating_system}</td>
                                    <td>{notebook.price}</td>
                                    <td>{notebook.pieces}</td>
                                    <td className="row-actions">
                                        <button
                                            type="button"
                                            className="btn btn-small"
                                            onClick={() => startEdit(notebook)}
                                        >
                                            Edit
                                        </button>
                                        <button
                                            type="button"
                                            className="btn btn-small btn-danger"
                                            onClick={() => void deleteNotebook(notebook)}
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    );
}