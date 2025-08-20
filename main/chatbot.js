// Chatbot Questions and Answers Definition
const chatFlow = {
    initial: {
        question: "Hello! Welcome to First Care Pest Management! How can I help you?",
        answers: {
            "bookingDetail": "How can I make a booking?",
            "paymentDetail": "I want to know about the payment details.",
            "contactDetail": "I want to contact the admin.",
            "accountDetail": "How can I create an user account?",
        },
    },
    bookingDetail: {
        question: "You can follow the step below to make a booking: \n\n1.Register an user account \n\n2.Login your user account \n\n3.Click the make booking button in your user dashboard \n\n4.View your booking status in the booking page \n\n5.Once the booking status became [confirmed], do your payment at the payment page \n\n6.Once the booking status became [completed] mean booking success, and wait for the admin call for services",
        answers: {
            "paymentWay": "How can I do the payment?",
            "availability":"How to check the service is available or not?",
            "initial": "Back",
        },
        responses: {
            "paymentWay": "Follow the step below to do you payment: \n\n1.Once your booking is confirmed, the price will show on the payment table \n\n2.Do you payment transfer to the bank account that show on the card [Do your payment] in the user dashboard \n\n3.Screenshot the payment resit and upload in the button that show on the payment table \n\n4.Wait for the admin to approve the payment, it usually take 1-2days",
            "availability": "Follow the step below to check the service availability: \n\n1.Login your user account \n\n2.There will have a service availability check in the home page, fill up the form \n\n3.And you can check the service that you want is available or not (Every Sunday is Holiday, no service available)",
        },
    },
    paymentDetail: {
        question: "Follow the step below to do you payment: \n\n1.Once your booking is confirmed, the price will show on the payment table \n\n2.Do you payment transfer to the bank account that show on the card [Do your payment] in the user dashboard \n\n3.Screenshot the payment resit and upload in the button that show on the payment table \n\n4.Wait for the admin to approve the payment, it usually take 1-2days",
        answers: {
            "initial": "Back",
        },
    
    },
    contactDetail: {
        question: "You can contact the admin through: \n\n1.Whatsapp: 0198231456 \n\n2.Email: firstcaremanagement@gmail.com",
        answers: {
            "initial": "Back",
        },
    },
    accountDetail: {
        question: "Here are the step to register your user account: \n\n1.Click the login icon on the top right of the page \n\n2.Follow the instruction button to create you own user account!",
        answers: {
            "initial": "Back",
        },
    },
};

let currentState = "initial";

// Toggle Chatbot Window
function toggleChat() {
    const chatbotWindow = document.getElementById("chatbot-window");
    chatbotWindow.style.display = chatbotWindow.style.display === "flex" ? "none" : "flex";

    if (chatbotWindow.style.display === "flex") {
        initChatbot();
    }
}

// Initialize Chatbot
function initChatbot() {
    currentState = "initial";
    const messages = document.getElementById("messages");
    messages.innerHTML = ""; // Clear previous messages
    addBotMessage(chatFlow[currentState].question);
    displayAnswerButtons(chatFlow[currentState].answers);
}

// Add Bot Message
function addBotMessage(text) {
    const messages = document.getElementById("messages");
    const botMessageDiv = document.createElement("div");
    botMessageDiv.className = "bot-message";
    // 支持换行显示
    botMessageDiv.innerHTML = text.replace(/\n/g, "<br>");
    messages.appendChild(botMessageDiv);
    messages.scrollTop = messages.scrollHeight;
}

// Display Answer Buttons (禁用或隐藏旧按钮)
function displayAnswerButtons(answers) {
    const messages = document.getElementById("messages");

    // 清除旧按钮（上一个问题的按钮容器）
    const oldButtonsDiv = document.querySelector(".buttons-container");
    if (oldButtonsDiv) {
        oldButtonsDiv.remove();
    }

    // 创建新的按钮容器
    const buttonsDiv = document.createElement("div");
    buttonsDiv.className = "buttons-container";

    for (const [key, value] of Object.entries(answers)) {
        const button = document.createElement("button");
        button.textContent = value;
        button.className = "answer-button";

        // 点击后禁用按钮，防止重复点击
        button.onclick = () => {
            handleAnswerClick(key);
            // 禁用当前按钮点击
            button.disabled = true;
            button.classList.add("disabled-button");
        };

        buttonsDiv.appendChild(button);
    }

    messages.appendChild(buttonsDiv);
    messages.scrollTop = messages.scrollHeight;
}

// Handle Button Click (回答问题后清理旧按钮)
function handleAnswerClick(answerKey) {
    const state = chatFlow[currentState];
    const nextState = state.responses?.[answerKey] ? null : answerKey;

    // 更新状态并显示新的问题或答案
    if (nextState) {
        currentState = nextState;
        addBotMessage(chatFlow[currentState].question);
        displayAnswerButtons(chatFlow[currentState].answers);
    } else {
        addBotMessage(state.responses[answerKey]);
    }
}