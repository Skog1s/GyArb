import Dexie from 'dexie';

export const db = new Dexie('NoteStorage');

db.version(1).stores({
    notes: '++id, title, body, createdAt, updatedAt',
});

// CRUD funktioner
export async function getNotes() {
    return db.notes.orderBy('createdAt').reverse().toArray();
}

export async function addNote(note) {
    const now = new Date();
    return db.notes.add({
        ...note,
        createdAt: now.toISOString(),
        updatedAt: now.toISOString(),
    });
}

export async function deleteNote(id) {
    return db.notes.delete(id);
}

export async function updateNote(id, updates) {
    updates.updatedAt = new Date().toISOString();
    return db.notes.update(id, updates);
}