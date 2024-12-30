import { Card, CardContent, Typography, Grid, Button } from '@mui/material';

const QuickLinks = () => {
  const links = [
    { id: 1, title: 'Dashboard', href: '/dashboard' },
    { id: 2, title: 'Lớp học', href: '/class-management' },
    { id: 3, title: 'Bài học', href: '/lessons' },
    { id: 4, title: 'Icons', href: '/icons' },
  ];

  return (
    <Card>
      <CardContent>
        <Typography variant="h6" gutterBottom>
          Quick Links
        </Typography>
        <Grid container spacing={2}>
          {links.map((link) => (
            <Grid item xs={12} sm={6} key={link.id}>
              <Button
                fullWidth
                variant="contained"
                color="primary"
                href={link.href}
              >
                {link.title}
              </Button>
            </Grid>
          ))}
        </Grid>
      </CardContent>
    </Card>
  );
};

export default QuickLinks;
