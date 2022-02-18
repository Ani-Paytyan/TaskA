//length validation
/**
 *
 * @param string
 * @param symbolMaxCount
 * @returns {boolean}
 */
function validateLength(string, symbolMaxCount) {
    return (string.length > symbolMaxCount)? false : true;
}

/**
 *
 * @param string
 * @returns {boolean}
 */
function validateEmpty(string) {
    string.classList.remove('error');
    if (string.value.length < 1) {
        string.classList.add('error');
        return false;
    }
    return true;
}

//password validation
/**
 *
 * @param email
 * @returns {boolean}
 */
function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( email );
}

/**
 * @param password
 * @param repeatPassword
 * @returns {boolean}
 */
function validatePasswordWithRepeatPassword(password, repeatPassword)
{
    return (repeatPassword !== password )? false : true;
}

//password validation
/**
 * @param string
 * @param passwordSymbolMaxCount
 * @param passwordSymbolMinCount
 * @returns {boolean}
 */
function validatePassword(string, passwordSymbolMaxCount, passwordSymbolMinCount)
{
    return (string.length > passwordSymbolMaxCount || string.length < passwordSymbolMinCount)? false : true;
}

