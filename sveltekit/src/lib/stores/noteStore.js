import { writable } from "svelte/store";

export const notes = writable([]);

export async function fetchNotes() { 
    try {
        const response = await fetch("/api/fetchNotes.php");
        const data = await response.json();
        if (response.ok) {
            notes.set(data);
        } else {
            console.error("Failed to fetch notes:", data.error);
        }
    } catch (err) {
        console.error("Error fetching notes:", err);
    }
}

export async function createNote(note) {
    try {
        const response = await fetch('/api/createNote.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(note)
        });
        const data = await response.json();
        if (response.ok && data.id) {
            notes.update(n => [...n, { ...note, id: data.id }]);
        } else {
            console.error("Failed to create note:", data.error);
        }
    } catch (err) {
        console.error("Error creating note:", err);
    }
}

export async function deleteNote(id) {
    const response = await fetch(`/api/deleteNote.php?id=${id}`);
    const data = await response.json();
    if (data.success) {
        notes.update(n => n.filter(note => note.id !== id));
    }
}