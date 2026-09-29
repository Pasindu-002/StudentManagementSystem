document.addEventListener(
    "DOMContentLoaded",
    function () {

        const deleteButtons =
            document.querySelectorAll(
                ".delete-btn"
            );

        deleteButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function (event) {

                        const confirmed =
                            confirm(
                                "Are you sure you want to delete this student?\n\nThis action cannot be undone."
                            );

                        if (!confirmed) {

                            event.preventDefault();

                        }

                    }
                );

            }
        );

    }
);