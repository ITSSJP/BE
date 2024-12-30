import { Card, CardContent, Typography } from '@mui/material';

const WelcomeCard = () => {
  return (
    <Card>
      <CardContent>
        <Typography variant="h5">Welcome to the Dashboard!</Typography>
        <Typography variant="body2"></Typography>
      </CardContent>
    </Card>
  );
};

export default WelcomeCard;
