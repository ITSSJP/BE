import { useState } from "react";

const languages = [
  { code: "en", name: "English" },
  { code: "vi", name: "Vietnamese" },
  { code: "ja", name: "Japanese" },
  { code: "fr", name: "French" },
  { code: "es", name: "Spanish" },
];

const mockTranslationAPI = (text, sourceLang, targetLang) => {
  const translations = {
    en: { vi: "Xin chào", ja: "こんにちは", fr: "Bonjour", es: "Hola" },
    vi: { en: "Hello", ja: "こんにちは", fr: "Bonjour", es: "Hola" },
  };
  return translations[sourceLang]?.[targetLang] || "Translation not available";
};

const ModernTranslateUI = () => {
  const [sourceLang, setSourceLang] = useState("en");
  const [targetLang, setTargetLang] = useState("vi");
  const [text, setText] = useState("");
  const [translatedText, setTranslatedText] = useState("");

  const handleTranslate = () => {
    if (!text.trim()) {
      setTranslatedText("Please enter text to translate.");
      return;
    }
    const result = mockTranslationAPI(text, sourceLang, targetLang);
    setTranslatedText(result);
  };

  const handleSwapLanguages = () => {
    setSourceLang(targetLang);
    setTargetLang(sourceLang);
    setText(translatedText);
    setTranslatedText(text);
  };

  return (
    <div style={styles.container}>
      <h1 style={styles.title}>Modern Translator</h1>
      <div style={styles.languageSelector}>
        <div style={styles.selectorGroup}>
          <label style={styles.label}>From:</label>
          <select
            style={styles.select}
            value={sourceLang}
            onChange={(e) => setSourceLang(e.target.value)}
          >
            {languages.map((lang) => (
              <option key={lang.code} value={lang.code}>
                {lang.name}
              </option>
            ))}
          </select>
        </div>

        <button style={styles.swapButton} onClick={handleSwapLanguages}>
          ↔
        </button>

        <div style={styles.selectorGroup}>
          <label style={styles.label}>To:</label>
          <select
            style={styles.select}
            value={targetLang}
            onChange={(e) => setTargetLang(e.target.value)}
          >
            {languages.map((lang) => (
              <option key={lang.code} value={lang.code}>
                {lang.name}
              </option>
            ))}
          </select>
        </div>
      </div>

      <div style={styles.textAreas}>
        <textarea
          style={styles.textarea}
          placeholder="Enter text here..."
          value={text}
          onChange={(e) => setText(e.target.value)}
        />

        <textarea
          style={{ ...styles.textarea, backgroundColor: "#f8f8f8" }}
          placeholder="Translation will appear here..."
          value={translatedText}
          readOnly
        />
      </div>

      <button style={styles.translateButton} onClick={handleTranslate}>
        Translate
      </button>
    </div>
  );
};

const styles = {
  container: {
    maxWidth: "700px",
    margin: "auto",
    fontFamily: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif",
    textAlign: "center",
    backgroundColor: "#fff",
    borderRadius: "8px",
    boxShadow: "0 4px 10px rgba(0, 0, 0, 0.1)",
    padding: "20px",
  },
  title: {
    fontSize: "24px",
    color: "#333",
    marginBottom: "20px",
  },
  languageSelector: {
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    marginBottom: "20px",
  },
  selectorGroup: {
    display: "flex",
    flexDirection: "column",
    alignItems: "center",
  },
  label: {
    fontSize: "14px",
    marginBottom: "5px",
    fontWeight: "bold",
    color: "#555",
  },
  select: {
    padding: "10px",
    fontSize: "16px",
    borderRadius: "4px",
    border: "1px solid #ddd",
    width: "150px",
  },
  swapButton: {
    fontSize: "18px",
    padding: "8px",
    borderRadius: "50%",
    border: "1px solid #ddd",
    backgroundColor: "#fff",
    cursor: "pointer",
    margin: "0 10px",
    transition: "0.3s",
  },
  textAreas: {
    display: "flex",
    justifyContent: "space-between",
    marginBottom: "20px",
  },
  textarea: {
    width: "48%",
    height: "100px",
    padding: "10px",
    fontSize: "16px",
    borderRadius: "4px",
    border: "1px solid #ddd",
    resize: "none",
  },
  translateButton: {
    width: "100%",
    padding: "12px",
    fontSize: "16px",
    backgroundColor: "#007bff",
    color: "#fff",
    border: "none",
    borderRadius: "4px",
    cursor: "pointer",
    transition: "0.3s",
  },
};

export default ModernTranslateUI;
