/* eslint-disable react/prop-types */
import { Box, Grid, Typography, Button } from '@mui/material';

const LessonList = ({ lessons }) => {
  return (
    <Box>
      <Typography variant="h5" gutterBottom>
        Danh sách bài học
      </Typography>
      <Grid container spacing={2}>
        {lessons.map((lesson) => (
          <Grid item xs={12} sm={6} md={4} key={lesson.id}>
            <Box sx={{ border: '1px solid #ccc', borderRadius: 2, padding: 2 }}>
              <Typography variant="h6">{lesson.title}</Typography>
              <Typography variant="body2" color="textSecondary">
                {lesson.description}
              </Typography>
              <Button
                variant="contained"
                color="primary"
                sx={{ marginTop: 2 }}
                onClick={() => alert(`Bạn đã chọn bài học: ${lesson.title}`)}
              >
                Xem bài học
              </Button>
            </Box>
          </Grid>
        ))}
      </Grid>
    </Box>
  );
};

export default LessonList;
