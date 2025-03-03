import "./bootstrap";

import 'lightbox2/dist/css/lightbox.css'; // Importa il CSS
import 'lightbox2/dist/js/lightbox-plus-jquery.js'; // Importa il JS

import 'livewire-sortable';


import Swal from "sweetalert2";

window.Swal = Swal;

window.addEventListener("swal:modal", (event) => {

    Swal.fire({
        position: event.detail[0].position,
        title: event.detail[0].title,
        text: event.detail[0].text,
        icon: event.detail[0].type,
        showConfirmButton: event.detail[0].showConfirmButton,
        confirmButtonText: event.detail[0].type,
        showCloseButton: event.detail[0].showCloseButton ? true : false,
        timer: 3000,
        toast: event.detail[0].toast,
        timerProgressBar: event.detail[0].type ? true : false,
        footer: event.detail[0].footer,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        willClose: () => {
            console.log(event.detail[0])
            Livewire.dispatch(event.detail[0].emit);

            if(!event.detail[0].dontClose){
                document.dispatchEvent(new Event('close-modal'));
            }
        },
    });
});

document.addEventListener('close-modal', function () {
    console.log('close-modal');
    var modals = document.querySelectorAll('.modal'); // Seleziona tutti i modali
    modals.forEach(function(modal) {
        // Verifica se il modal è aperto
        if (modal.classList.contains('show')) {
            // Usa i metodi di Bootstrap 5 per chiudere il modal
            var modalInstance = coreui.Modal.getInstance(modal); // Assicurati di usare bootstrap.Modal
            if (modalInstance) {
                modalInstance.hide(); // Chiude il modal
            }
        }
    });
});

