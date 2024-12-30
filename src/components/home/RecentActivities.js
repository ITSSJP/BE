import { Card, CardContent, Typography, List, ListItem, ListItemText } from '@mui/material';

const RecentActivities = () => {
  const activities = [
    { id: 1, description: 'Bạn vừa hoàn thành bài học Kanji số 1.', time: '10 phút trước' },
    { id: 2, description: 'Lớp học "ABC" đã được cập nhật.', time: '1 giờ trước' },
    { id: 3, description: 'Bạn vừa tham gia lớp "ABC".', time: 'Hôm qua' },
  ];

  return (
    <Card>
      <CardContent>
        <Typography variant="h6" gutterBottom>
          Recent Activities
        </Typography>
        <List>
          {activities.map((activity) => (
            <ListItem key={activity.id} disableGutters>
              <ListItemText
                primary={activity.description}
                secondary={activity.time}
              />
            </ListItem>
          ))}
        </List>
      </CardContent>
    </Card>
  );
};

export default RecentActivities;
