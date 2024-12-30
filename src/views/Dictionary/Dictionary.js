import { useState } from "react";

const mockDictionary = {
  hello: { translation: "こんにちは", reading: "Kon’nichiwa" },
  world: { translation: "世界", reading: "Sekai" },
  study: { translation: "勉強", reading: "Benkyou" },
  book: { translation: "本", reading: "Hon" },
};

const Dictionary = () => {
  const [query, setQuery] = useState("");
  const [result, setResult] = useState(null);
  const [history, setHistory] = useState([]);

  const handleSearch = () => {
    const word = query.trim().toLowerCase(); // Chuyển từ thành chữ thường
    if (mockDictionary[word]) {
      const data = mockDictionary[word];
      setResult({ word, ...data });
      setHistory((prev) => [word, ...prev.filter((item) => item !== word)]);
    } else {
      setResult({
        word: query,
        translation: "Not found",
        reading: "N/A",
      });
    }
  };

  const handleSpeak = (text, lang = "en-US") => {
    if ("speechSynthesis" in window) {
      const utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = lang; // Thiết lập ngôn ngữ
      speechSynthesis.speak(utterance);
    } else {
      alert("Your browser does not support text-to-speech.");
    }
  };

  return (
    <div style={styles.container}>
      <h1 style={styles.title}>Dictionary</h1>
      <div style={styles.searchContainer}>
        <input
          type="text"
          placeholder="Enter a word"
          value={query}
          onChange={(e) => setQuery(e.target.value)}
          style={styles.input}
        />
        <button onClick={handleSearch} style={styles.button}>
          Search
        </button>
      </div>

      {result && (
        <div style={styles.resultBox}>
          <h2 style={styles.word}>
            {result.word}{" "}
            <button
              onClick={() => handleSpeak(result.word, result.translation !== "Not found" ? "ja-JP" : "en-US")}
              style={styles.iconButton}
            >
              🔊
            </button>
          </h2>
          <p>
            <strong>Translation:</strong> {result.translation}
          </p>
          <p>
            <strong>Reading:</strong> {result.reading}
          </p>
        </div>
      )}

      <h2>Search History</h2>
      <ul style={styles.historyList}>
        {history.map((item, index) => (
          <li key={index} style={styles.historyItem}>
            <span>{item}</span>
            <button onClick={() => handleSpeak(item)} style={styles.iconButton}>
              🔊
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
};

const styles = {
  container: {
    padding: "20px",
    fontFamily: "Arial, sans-serif",
  },
  title: {
    fontSize: "24px",
    marginBottom: "20px",
  },
  searchContainer: {
    display: "flex",
    gap: "10px",
    marginBottom: "20px",
  },
  input: {
    flex: 1,
    padding: "8px",
    fontSize: "16px",
    borderRadius: "4px",
    border: "1px solid #ccc",
  },
  button: {
    padding: "8px 16px",
    fontSize: "16px",
    backgroundColor: "#007BFF",
    color: "#fff",
    border: "none",
    borderRadius: "4px",
    cursor: "pointer",
  },
  resultBox: {
    border: "1px solid #ddd",
    padding: "15px",
    borderRadius: "4px",
    marginBottom: "20px",
    backgroundColor: "#f9f9f9",
  },
  word: {
    display: "flex",
    alignItems: "center",
    gap: "10px",
  },
  iconButton: {
    fontSize: "18px",
    background: "none",
    border: "none",
    cursor: "pointer",
  },
  historyList: {
    listStyleType: "none",
    padding: 0,
  },
  historyItem: {
    display: "flex",
    justifyContent: "space-between",
    padding: "5px 0",
    borderBottom: "1px solid #ddd",
  },
};

export default Dictionary;
