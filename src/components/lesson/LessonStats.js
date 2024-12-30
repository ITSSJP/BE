import { Card, CardContent, Typography, Grid } from '@mui/material';

const LessonStats = () => {
  const stats = [
    { label: 'Total Lessons', value: 120 },
    { label: 'Completed Lessons', value: 95 },
    { label: 'In Progress', value: 20 },
  ];

  return (
    <Card>
      <CardContent>
        <Typography variant="h6" gutterBottom>
          Lesson Statistics
        </Typography>
        <Grid container spacing={2}>
          {stats.map((stat, index) => (
            <Grid item xs={4} key={index}>
              <Typography variant="h5" color="primary">
                {stat.value}
              </Typography>
              <Typography variant="subtitle2">{stat.label}</Typography>
            </Grid>
          ))}
        </Grid>
      </CardContent>
    </Card>
  );
};

export default LessonStats;
