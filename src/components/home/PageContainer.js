import { Box, Typography } from '@mui/material';


// eslint-disable-next-line react/prop-types
const PageContainer = ({ title, description, children }) => {
  return (
    <Box sx={{ p: 3, backgroundColor: '#f9f9f9', minHeight: '100vh' }}>
      {/* Header: Title và Description */}
      <Box sx={{ mb: 4 }}>
        <Typography variant="h4" component="h1" gutterBottom>
          {title}
        </Typography>
        {description && (
          <Typography variant="subtitle1" color="textSecondary">
            {description}
          </Typography>
        )}
      </Box>

      {/* Nội dung của trang */}
      {children}
    </Box>
  );
};

export default PageContainer;
