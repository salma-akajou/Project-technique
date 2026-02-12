export const baseLogic = () => ({
    isLoading: false,
    error: null,

    async performFetch(fetchFn, successCallback) {
        this.isLoading = true;
        this.error = null;
        try {
            const response = await fetchFn();
            if (successCallback) successCallback(response);
            return response;
        } catch (err) {
            this.error = "Une erreur est survenue lors de la récupération des données.";
            console.error("Fetch Error:", err);
        } finally {
            this.isLoading = false;
        }
    },

    reinitUI() {
        this.$nextTick(() => {
            if (window.HSStaticMethods) window.HSStaticMethods.autoInit();
            if (window.createIcons) window.createIcons({ icons: window.icons });
        });
    }
});

export const baseManager = () => ({
    search: '',
    entityTable: '',
    isOpen: false,
    editMode: false,

    openModalBase(id = null) {
        this.editMode = !!id;
        this.isOpen = true;
        this.reinitUI?.();
    },

    closeModalBase() {
        this.isOpen = false;
    }
});
