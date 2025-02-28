import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

console.log("boooooo");
document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-coreui-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new coreui.Tooltip(tooltipTriggerEl)
    );
    const popoverTriggerList = document.querySelectorAll(
        '[data-coreui-toggle="popover"]'
    );
    const popoverList = [...popoverTriggerList].map(
        (popoverTriggerEl) => new coreui.Popover(popoverTriggerEl)
    );

    // gestione blocker aria-hidden
    handleBlockedAriaHiddenModal();
});

function handleBlockedAriaHiddenModal() {
    // Ascolta l'evento 'hide.coreui.modal' (emesso prima che il modal venga nascosto)
    document.addEventListener("hide.coreui.modal", function (event) {
        const modal = event.target; // Il modal che sta per essere nascosto

        // Trova l'elemento focalizzato all'interno del modal
        const focusedElement = modal.querySelector(":focus");
        if (focusedElement) {
            //console.log('Rimuovo il focus da:', focusedElement);
            focusedElement.blur(); // Rimuovi il focus
        }
    });

    // Ascolta l'evento 'hidden.coreui.modal' (emesso dopo che il modal è stato nascosto)
    /* document.addEventListener('hidden.coreui.modal', function(event) {
            console.log('Modal nascosto:', event.target.id);
        }); */
}
