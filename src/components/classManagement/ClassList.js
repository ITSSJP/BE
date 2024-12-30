import { Box, Grid, Typography, Button } from '@mui/material';
import { useNavigate } from 'react-router-dom';

const ClassList = ({ classes }) => {
  const navigate = useNavigate();

  return (
    <Grid container spacing={2}>
      {classes.map((classItem) => (
        <Grid item xs={12} sm={6} md={4} key={classItem.id}>
          <Box sx={{ border: '1px solid #ccc', borderRadius: 2, padding: 2 }}>
            <Typography variant="h6">{classItem.name}</Typography>
            <Typography variant="body2" color="textSecondary">
              {classItem.members} thành viên
            </Typography>
            <Button
              variant="contained"
              color="primary"
              sx={{ marginTop: 2 }}
              onClick={() => navigate(`/class/${classItem.id}`)}
            >
              Xem Bài Học
            </Button>
          </Box>
        </Grid>
      ))}
    </Grid>
  );
};

export default ClassList;
