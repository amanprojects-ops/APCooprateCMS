{{-- ===================================================
     GLOBAL DELETE CONFIRMATION MODAL
     Usage: Add x-data="deleteModal()" to a parent,
     then trigger with @click="confirm(action_url, label)"
     =================================================== --}}

<div x-data="deleteModal()" x-cloak>
    <div class="modal-overlay-admin" x-show="show" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="modal-box-admin" @click.stop>

            {{-- Icon --}}
            <div class="modal-icon-admin">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
            </div>

            {{-- Content --}}
            <div class="modal-title-admin">Delete Confirmation</div>
            <p class="modal-text-admin">
                Are you sure you want to delete <strong x-text="itemLabel"></strong>?<br>
                <span style="font-size:.78rem;color:#ef4444;">This action cannot be undone.</span>
            </p>

            {{-- Actions --}}
            <div class="modal-actions-admin">
                <button type="button"
                        class="btn-admin btn-secondary-admin"
                        @click="show = false"
                        id="modal-cancel-btn">
                    Cancel
                </button>

                <form :action="actionUrl" method="POST" id="delete-confirm-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn-admin btn-danger-admin"
                            id="modal-confirm-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                        </svg>
                        Yes, Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
function deleteModal() {
    return {
        show: false,
        actionUrl: '',
        itemLabel: '',
        confirm(url, label) {
            this.actionUrl = url;
            this.itemLabel = label || 'this item';
            this.show = true;
        }
    }
}
</script>
