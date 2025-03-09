const isFaqPage = document.title === 'SDLC FAQ';
const isLoginPage = document.title === 'SDLC FAQ - Login';
const isSignupPage = document.title === 'SDLC FAQ - SignUp';
const isAddQuestionPage = document.title === 'SDLC FAQ - Add Question';

if(isLoginPage){
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const loginButton = document.getElementById('loginButton');
    const signupRedirect = document.getElementById('signupRedirect');
    const loginError = document.getElementById('loginError');
    loginButton.addEventListener('click', async ()=>{
        const form = new FormData();
        form.append('email', emailInput.value);
        form.append('password', passwordInput.value);
        try{
            const response = await axios.post(
                '/Article/article-server/APIs/v1/login.php',
                form
            );

            if(response.data.success){
                localStorage.setItem('user', JSON.stringify(response.data.user));
                window.location.href = 'FAQ.html';
            } else {
                loginError.textContent = response.data.message;
            }
        } catch(error){
            console.error('Login error: ', error);
            loginError.textContent = 'Wrong Email or Password'
        }
    });
    signupRedirect.addEventListener('click',()=>{
        window.location.href = 'signup.html';
    })
}

if(isSignupPage){
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const fullnameInput = document.getElementById('fullname');
    const backButton = document.getElementById('backButton');
    const signupSubmit = document.getElementById('signupSubmit');
    const loginError = document.getElementById('loginError');
    signupSubmit.addEventListener('click', async()=>{
        const form = new FormData();
        form.append('email', emailInput.value);
        form.append('password', passwordInput.value);
        form.append('fullname', fullnameInput.value);
        try{
            const response = await axios.post(
                '/Article/article-server/APIs/v1/signup.php',
                form
            );

            if(response.data.success){
                localStorage.setItem('user', JSON.stringify(response.data.user));
                window.location.href = "index.html";
            } else {
                loginError.textContent = response.data.message;
            }
        } catch (error){
            console.error('Signup Error: ', error);
            loginError.textContent = 'Server error occured';
        }
    });
    backButton.addEventListener('click', () => {
        window.location.href = 'index.html';
      });    
}

if(isFaqPage){
    const searchInput = document.getElementById('searchInput');
    const questionContainer = document.getElementById('questionContainer');
    const loadQuestions = async () => {
        try{
            const response = await axios.get(
                '/Article/article-server/APIs/v1/getQuestions.php.php'
            );
            console.log('API Response:', response.data);

            if (response.data.success){
                displayQuestions(response.data.questions);
            }else{
                questionContainer.innerHTML = '<p class = "error-message"> Failed to load questions </p>';
            }
        } catch(error){
            console.error('Error loading questions: ', error);
            questionContainer.innerHTML = '<p class="error-message">Error connecting to server</p>';
        }
    };

    const displayQuestions = (questions) =>{
        if (questions.length === 0){
            questionContainer.innerHTML = '<p>No questions found</p>';
            return;
        }

        const html = questions.map(q => 
            `<div class="question-card">
                <h3>${q.question}</h3>
                <p>${q.answer}</p>
            </div>`
        ).join('');
        
        questionContainer.innerHTML = html;
    };

    loadQuestions();

    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.toLowerCase();
        const cards = document.querySelectorAll('.question-card');
        
        for(let i = 0; i < cards.length; i++) {
            const card = cards[i];
            const question = card.querySelector('h3').textContent.toLowerCase();
            const answer = card.querySelector('p').textContent.toLowerCase();
            
            if(question.includes(searchText) || answer.includes(searchText)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });
}   

if(isAddQuestionPage){
    const questionInput = document.getElementById('question');
    const answerInput = document.getElementById('answer');
    const submitQuestion = document.getElementById('submitQuestion');
    const backButton = document.getElementById('backButton');
    backButton.addEventListener('click', () => {
        window.location.href = 'FAQ.html';
    });
          
    submitQuestion.addEventListener('click', async ()=>{
        const question  = questionInput.value;
        const answer = answerInput.value;

        if (!question || !answer){
        alert('Please fill in both question and answer fields');
        return;
        }

        try{

                const response = await axios.post(
                '/Article/article-server/APIs/v1/addQuestion.php',
                {
                    question: question,
                    answer: answer
                }
            );

            if(response.data.success){
                window.location.href = 'FAQ.html';
            }else {
                alert('Failed to add question');
            }
        }catch(error){
            console.error('Error adding question', error);
        }
    });
}