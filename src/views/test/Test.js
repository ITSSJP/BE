/* eslint-disable react/prop-types */
import  { useState } from "react";

// Component để hiển thị giao diện câu hỏi
const TestQuestionView = ({ question, options, onSelectOption, score }) => {
  return (
    <div style={styles.container}>
      <h2 style={styles.question}>{question}</h2>
      <div style={styles.optionsContainer}>
        {options.map((option, index) => (
          <button
            key={index}
            style={styles.optionButton}
            onClick={() => onSelectOption(option)}
          >
            {option}
          </button>
        ))}
      </div>
      <p style={styles.score}>Score: {score}</p>
    </div>
  );
};

// Component để hiển thị điểm cuối cùng
const FinalScoreView = ({ score, totalQuestions }) => {
  return (
    <div style={styles.container}>
      <h2 style={styles.finalScore}>Quiz Finished!</h2>
      <p style={styles.finalMessage}>
        Your score is <strong>{score}</strong> out of {totalQuestions}.
      </p>
      <button
        style={styles.restartButton}
        onClick={() => window.location.reload()}
      >
        Restart Quiz
      </button>
    </div>
  );
};

// Component chính để quản lý logic bài kiểm tra
const TestUI = () => {
  const questionSet = [
    {
      question: "Nghĩa của từ: 勉強?",
      options: ["Study", "Eat", "Sleep", "Run"],
      correctAnswer: "Study",
    },
    {
      question: "Nghĩa của từ: 本?",
      options: ["Book", "Car", "Water", "Fire"],
      correctAnswer: "Book",
    },
    {
      question: "Nghĩa của từ: 学校?",
      options: ["School", "Home", "Store", "Park"],
      correctAnswer: "School",
    },
  ];

  const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
  const [score, setScore] = useState(0);
  const [isFinished, setIsFinished] = useState(false);

  const handleOptionSelect = (selectedOption) => {
    const currentQuestion = questionSet[currentQuestionIndex];
    if (selectedOption === currentQuestion.correctAnswer) {
      setScore(score + 1); // Cộng điểm nếu đúng
    }

    // Chuyển sang câu hỏi tiếp theo hoặc kết thúc bài kiểm tra
    if (currentQuestionIndex < questionSet.length - 1) {
      setCurrentQuestionIndex(currentQuestionIndex + 1);
    } else {
      setIsFinished(true); // Đánh dấu hoàn thành bài kiểm tra
    }
  };

  const currentQuestion = questionSet[currentQuestionIndex];

  // Hiển thị bài kiểm tra hoặc điểm cuối cùng
  return isFinished ? (
    <FinalScoreView score={score} totalQuestions={questionSet.length} />
  ) : (
    <TestQuestionView
      question={currentQuestion.question}
      options={currentQuestion.options}
      onSelectOption={handleOptionSelect}
      score={score}
    />
  );
};

// Inline CSS styles
const styles = {
  container: {
    margin: "50px auto",
    padding: "20px",
    width: "400px",
    textAlign: "center",
    border: "1px solid #ddd",
    borderRadius: "10px",
    backgroundColor: "#f9f9f9",
    boxShadow: "0 4px 6px rgba(0, 0, 0, 0.1)",
  },
  question: {
    fontSize: "20px",
    marginBottom: "20px",
    color: "#333",
  },
  optionsContainer: {
    display: "flex",
    flexDirection: "column",
    gap: "10px",
  },
  optionButton: {
    padding: "10px 20px",
    fontSize: "16px",
    border: "none",
    borderRadius: "5px",
    cursor: "pointer",
    backgroundColor: "#78EFFA",
    color: "#000000",
    transition: "background-color 0.3s",
  },
  score: {
    marginTop: "20px",
    fontSize: "18px",
    color: "#666",
  },
  finalScore: {
    fontSize: "24px",
    color: "#333",
    marginBottom: "10px",
  },
  finalMessage: {
    fontSize: "18px",
    color: "#666",
    marginBottom: "20px",
  },
  restartButton: {
    padding: "10px 20px",
    fontSize: "16px",
    border: "none",
    borderRadius: "5px",
    cursor: "pointer",
    backgroundColor: "#28a745",
    color: "#fff",
    transition: "background-color 0.3s",
  },
};

export default TestUI;
