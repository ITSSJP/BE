import { Card, CardContent, CardMedia, Typography, Button } from '@mui/material';

const FeaturedLesson = () => {
  const lesson = {
    title: 'Introduction to React',
    description: 'Learn the basics of React, including components, hooks, and state management.',
    image: 'https://via.placeholder.com/400',
    link: '#',
  };

  return (
    <Card>
      <CardMedia
        component="img"
        height="140"
        image={lesson.image}
        alt={lesson.title}
      />
      <CardContent>
        <Typography variant="h6" gutterBottom>
          {lesson.title}
        </Typography>
        <Typography variant="body2" color="textSecondary" gutterBottom>
          {lesson.description}
        </Typography>
        <Button variant="contained" color="primary" href={lesson.link}>
          View Lesson
        </Button>
      </CardContent>
    </Card>
  );
};

export default FeaturedLesson;
