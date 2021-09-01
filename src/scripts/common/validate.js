config.inputs && config.inputs.forEach(function(input) {
    input.addEventListener('keyup', function(event) {
        const validPattern = input.getAttribute('data-valid-pattern');

        if (validPattern) {
            const checkValidRegExp = new RegExp(validPattern);
            const isValid = checkValidRegExp.test(event.target.value);

            config.postBtn.style.display = isValid ? 'inline-block' : 'none';
            input.style.border = '2px solid ' +  (isValid ? config.colorOk : config.colorError);
        }
    });
});
