let display = document.getElementById('display');
let currentInput = '';
let operator = null;
let firstOperand = null;
let secondOperand = null;
let shouldResetDisplay = false;

function append(num) {
    if (shouldResetDisplay) {
        currentInput = '';
        shouldResetDisplay = false;
    }
    if (currentInput === '0' && num !== '.') {
        currentInput = num; 
    } else {
        currentInput += num;
    }
    updateDisplay();
}

function operate(op) {
    if (currentInput !== '') {
        if (firstOperand === null) {
            firstOperand = parseFloat(currentInput);
        } else if (operator) {
            secondOperand = parseFloat(currentInput);
            firstOperand = calculate();
        }
        operator = op;
        currentInput = '';
        shouldResetDisplay = true;
    }
}

function calculate() {
    if (operator && firstOperand !== null && currentInput !== '') {
        secondOperand = parseFloat(currentInput);
        let result;
        switch (operator) {
            case '+':
                result = firstOperand + secondOperand;
                break;
            case '-':
                result = firstOperand - secondOperand;
                break;
            case '*':
                result = firstOperand * secondOperand;
                break;
            case '/':
                result = firstOperand / secondOperand;
                break;
            case '^':
                result = Math.pow(firstOperand, secondOperand);
                break;
            case '%':
                result = firstOperand % secondOperand;
                break;
            default:
                return;
        }
        currentInput = result.toString();
        operator = null;
        firstOperand = null;
        secondOperand = null;
        shouldResetDisplay = true;
        updateDisplay();
        return result;
    }
    return firstOperand;
}

function clearAll() {
    currentInput = '0';
    operator = null;
    firstOperand = null;
    secondOperand = null;
    updateDisplay();
}

function updateDisplay() {
    display.innerText = currentInput || '0';
}

// Clear functionality
document.getElementById('clear').addEventListener('click', clearAll);

// Handle '=' button click
function equal() {
    if (operator !== null && firstOperand !== null && currentInput !== '') {
        calculate();
        shouldResetDisplay = true;
    }
}

// Assign "=" button function
document.querySelector('.equals').addEventListener('click', equal);
