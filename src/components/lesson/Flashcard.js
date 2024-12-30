/* eslint-disable react/prop-types */
import { useState } from "react";
import { Card, CardContent, Typography, Box, Button, IconButton } from "@mui/material";
import { motion } from "framer-motion";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faVolumeUp } from '@fortawesome/free-solid-svg-icons';
const Flashcard = ({ flashcards }) => {
  const [index, setIndex] = useState(0);
  const [flipped, setFlipped] = useState(false);

  const speak = (text) => {
    if ("speechSynthesis" in window) {
      const utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = "ja-JP"; // Adjust language based on the term
      utterance.rate = 1; // Speed of speech
      speechSynthesis.speak(utterance);
    } else {
      alert("Your browser does not support text-to-speech.");
    }
  };

  const handleNext = () => {
    setFlipped(false);
    setIndex((prev) => (prev + 1) % flashcards.length);
  };

  const handlePrev = () => {
    setFlipped(false);
    setIndex((prev) => (prev - 1 + flashcards.length) % flashcards.length);
  };

  const handleFlip = () => setFlipped(!flipped);

  return (
    <Box sx={{ textAlign: "center", mt: 5 }}>
      <Box sx={{ perspective: "1000px", display: "inline-block" }}>
        <motion.div
          onClick={handleFlip}
          style={{
            width: "300px",
            height: "200px",
            cursor: "pointer",
            transformStyle: "preserve-3d",
            transition: "transform 0.6s",
            transform: flipped ? "rotateY(180deg)" : "rotateY(0deg)",
          }}
        >
          {/* Front Side */}
          <Card
            sx={{
              position: "absolute",
              width: "100%",
              height: "100%",
              backfaceVisibility: "hidden",
            }}
          >
            <CardContent
              sx={{
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                flexDirection: "column",
                height: "100%",
              }}
            >
              <Typography variant="h5" color="textPrimary">
                {flashcards[index].term}
              </Typography>
              <IconButton onClick={(e) => { e.stopPropagation(); speak(flashcards[index].term); }}>
              <FontAwesomeIcon icon={faVolumeUp} />
              </IconButton>
            </CardContent>
          </Card>

          {/* Back Side */}
          <Card
            sx={{
              position: "absolute",
              width: "100%",
              height: "100%",
              backfaceVisibility: "hidden",
              transform: "rotateY(180deg)",
            }}
          >
            <CardContent
              sx={{
                display: "flex",
                flexDirection: "column",
                justifyContent: "center",
                alignItems: "center",
                height: "100%",
              }}
            >
              <Typography variant="body1" color="textSecondary">
                {flashcards[index].definition}
              </Typography>
              <Typography variant="caption" color="textSecondary" mt={2}>
                {flashcards[index].reading}
              </Typography>
            </CardContent>
          </Card>
        </motion.div>
      </Box>

      {/* Navigation */}
      <Box sx={{ display: "flex", justifyContent: "center", mt: 3 }}>
        <Button onClick={handlePrev} variant="outlined" sx={{ mx: 1 }}>
          Prev
        </Button>
        <Typography variant="subtitle1" sx={{ mx: 2 }}>
          {index + 1}/{flashcards.length}
        </Typography>
        <Button onClick={handleNext} variant="outlined" sx={{ mx: 1 }}>
          Next
        </Button>
      </Box>
    </Box>
  );
};

export default Flashcard;
