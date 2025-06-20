import Swal from "sweetalert2";
window.Swal = Swal;
// Login
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector('form[action*="login"]');
    if (!loginForm) return;
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        try {
            const res = await fetch(loginForm.action, {
                method: "POST",
                body: new FormData(loginForm),
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            });
            const data = await res.json();
            Swal.fire({
                icon: data.status,
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                if (data.status === "success" && data.redirect) {
                    window.location.href = data.redirect;
                }
            });
        } catch {
            Swal.fire({
                icon: "error",
                title: "Ocurrió un error inesperado",
            });
        }
    });
});
// Delete AJAX
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-form").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure to delete this record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "DELETE",
                cancelButtonText: "CANCEL",
            }).then((result) => {
                if (!result.isConfirmed) return;
                const action = form.action;
                const token = form.querySelector('input[name="_token"]').value;
                fetch(action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": token,
                        "X-Requested-With": "XMLHttpRequest",
                        Accept: "application/json",
                    },
                    body: new URLSearchParams(new FormData(form)),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: data.success,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(() => {
                                location.reload();
                            });
                        } else if (data.error) {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error,
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Errr: Unexpected error occurred",
                        });
                    });
            });
        });
    });
});

// Clear search input and submit
document.addEventListener("DOMContentLoaded", function () {
    const clearBtn = document.getElementById("clear-search");
    const input = document.getElementById("search-input");
    if (clearBtn && input) {
        clearBtn.addEventListener("click", function () {
            input.value = "";
            input.form.submit();
        });
    }
});
// Sort links
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".sort-link").forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const clickedSort = this.dataset.sort;
            const url = new URL(window.location.href);
            const currentSort = url.searchParams.get("sort");
            const currentDirection = url.searchParams.get("direction") || "asc";
            let nextDirection = "asc";
            if (clickedSort === currentSort && currentDirection === "asc") {
                nextDirection = "desc";
            }
            url.searchParams.set("sort", clickedSort);
            url.searchParams.set("direction", nextDirection);
            // Redirige (recarga completa)
            window.location.href = url;
        });
    });
});
// AJAX search form submission
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("ajax-search-form");
    const tableContainer = document.getElementById("table-container");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const params = new URLSearchParams(formData).toString();
        fetch(window.location.pathname + "?" + params, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
        })
            .then((res) => res.text())
            .then((html) => {
                // Solo reemplazamos la tabla dentro del contenedor
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const newTable = doc.querySelector("table");

                const oldTable = tableContainer.querySelector("table");
                if (oldTable && newTable) {
                    oldTable.outerHTML = newTable.outerHTML;
                }
            })
            .catch((err) => console.error(err));
    });
});
// Coloca esto en tu Blade, después de cargar jQuery
$("#ajax-search-form").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr("action"), // o la URL correspondiente
        data: $(this).serialize(),
        success: function (response) {
            $("#table-container").html(response);
        },
    });
});
// Para paginación AJAX
$(document).on("click", "#table-container .pagination a", function (e) {
    e.preventDefault();
    let url = $(this).attr("href");
    $.get(url, function (response) {
        $("#table-container").html(response);
    });
});
