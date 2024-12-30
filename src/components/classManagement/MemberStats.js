import { Box, Typography, LinearProgress } from '@mui/material';

// eslint-disable-next-line react/prop-types
const MemberStats = ({ members }) => {
  // Giả lập số lượng thành viên
  const maxMembers = 50;  // Số lượng thành viên tối đa
  const progress = (members / maxMembers) * 100;

  return (
    <Box sx={{ padding: 2 }}>
      <Typography variant="h6" gutterBottom>
        Số lượng thành viên
      </Typography>
      <LinearProgress 
        variant="determinate" 
        value={progress} 
        sx={{ marginBottom: 2 }}
      />
      <Typography variant="body2">
        {members} / {maxMembers} thành viên
      </Typography>
    </Box>
  );
};

export default MemberStats;
