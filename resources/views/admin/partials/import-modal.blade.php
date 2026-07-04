<dialog id="importModal" style="padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 400px; max-width: 90%; margin: auto; z-index: 9999;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 style="margin: 0; font-size: 1.1rem; font-weight: 600;">Import {{ $title ?? 'Data' }}</h3>
        <button type="button" onclick="document.getElementById('importModal').close()" style="background: none; border: none; cursor: pointer; font-size: 1.2rem;">&times;</button>
    </div>
    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-size: 0.85rem; font-weight: 500;">Excel/CSV File</label>
            <input type="file" name="file" accept=".xlsx,.csv,.xls" required style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 0.85rem;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:5px;">
                <small style="color:#64748b;">File must contain proper column headers matching the export format.</small>
                <a href="{{ str_replace('import', 'export', $route) }}" style="font-size:0.8rem; color:#0ea5e9; text-decoration:none; font-weight:600;">Download Sample</a>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').close()">Cancel</button>
            <button type="submit" class="btn-admin btn-primary-admin">Upload & Import</button>
        </div>
    </form>
</dialog>
