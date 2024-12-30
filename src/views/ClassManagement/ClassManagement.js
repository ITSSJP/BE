import { Box, Typography } from '@mui/material';
import ClassList from '../../components/classManagement/ClassList';

const ClassManagement = () => {
  // Giả lập dữ liệu nhóm và số lượng thành viên
  const classes = [
    { id: 1, name: 'Lớp học Tiếng Nhật', members: 35 },
    { id: 2, name: 'Lớp học Toán', members: 40 },
    { id: 3, name: 'Lớp học Lập trình Web', members: 28 },
  ];

  return (
    <Box sx={{ padding: 3 }}>
      <Typography variant="h4" gutterBottom>
        Quản lý lớp học
      </Typography>

      {/* Sử dụng ClassList để hiển thị danh sách lớp */}
      <ClassList classes={classes} />
    </Box>
  );
};

export default ClassManagement;
