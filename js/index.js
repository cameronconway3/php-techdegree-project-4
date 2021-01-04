const keyrows = document.querySelectorAll('.keyrow');

// Loop through each of the keyrows
for(let i = 0; i < keyrows.length; i++) {
    // Loop through each key within each keyrow
    for(let j = 0; j < keyrows[i].children.length; j++) {
        const key = keyrows[i].children[j];
        const keyValue = key.value;
        // Listen out for a keydown event on each key
        document.addEventListener('keydown', e => {
            // If the event key is the same as the value of the looped through key created a new form
            if(e.key == keyValue) {
                // Form acts exactly the same way as the form created in the 'displayKeyboard()' class but with only one value
                const form = document.createElement("form");
                const input = document.createElement("input");

                form.method = "POST";
                form.action = "play.php";

                input.value = keyValue;
                input.name = "key";
                form.appendChild(input); 

                form.style.display = "none";

                document.body.appendChild(form);

                // Submit the form
                form.submit();                
            }
        })
    }
}



