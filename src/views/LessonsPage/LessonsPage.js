import { Grid, Box } from "@mui/material";
import PageContainer from "../../components/container/PageContainer";

// Import Flashcard component
import Flashcard from "../../components/lesson/Flashcard";

const LessonsPage = () => {
  // Dữ liệu flashcards
  const flashcards = [
    {
      term: "猫", // Từ tiếng Nhật
      reading: "ねこ (neko)", // Furigana
      definition: "Con mèo", // Nghĩa tiếng Việt
    },
    {
      term: "犬",
      reading: "いぬ (inu)",
      definition: "Con chó",
    },
    {
      term: "車",
      reading: "くるま (kuruma)",
      definition: "Xe hơi",
    },
    {
      term: "山",
      reading: "やま (yama)",
      definition: "Ngọn núi",
    },
    {
      term: "海",
      reading: "うみ (umi)",
      definition: "Biển",
    },
  ];

  return (
    <PageContainer title="Flashcards" description="Learn with flashcards">
      <Box>
        <Grid container spacing={3}>
          <Grid item xs={12}>
            <Flashcard flashcards={flashcards} />
          </Grid>
        </Grid>
      </Box>
    </PageContainer>
  );
};

export default LessonsPage;
