import { useParams } from 'react-router-dom';
import { Box, Grid, Typography, Button, Paper,TextField, Table, TableBody, TableCell, TableContainer, TableHead, TableRow } from '@mui/material';
import LessonList from '../../components/lesson/LessonList';


const ClassDetail = () => {
  const { classId } = useParams(); // Lấy ID lớp từ URL

  // Giả lập dữ liệu bài học và lớp học
  const classData = {
    1: {
      name: 'Lớp học Tiếng Nhật',
      members: 35,
      lessons: [
        { id: 1, title: 'Giới thiệu Hiragana', description: 'Học bảng chữ cái Hiragana' },
        { id: 2, title: 'Từ vựng cơ bản', description: 'Những từ vựng cơ bản trong tiếng Nhật' },
        { id: 3, title: 'Chữ Katakana', description: 'Học bảng chữ cái Katakana' },
        { id: 4, title: 'Ngữ pháp cơ bản', description: 'Những cấu trúc ngữ pháp cơ bản trong tiếng Nhật' },
        { id: 5, title: 'Kanji cơ bản', description: 'Học các chữ Kanji cơ bản' },
        { id: 6, title: 'Giao tiếp cơ bản', description: 'Học giao tiếp cơ bản trong tiếng Nhật' },
      ],
      membersDetail: [
        { id: 1, name: 'Nguyễn Văn A', age: 20, phone: '0123456789', email: 'a@example.com' },
        { id: 2, name: 'Trần Thị B', age: 22, phone: '0987654321', email: 'b@example.com' },
        { id: 3, name: 'Lê Văn C', age: 25, phone: '0112233445', email: 'c@example.com' },
        { id: 4, name: 'Hoàng Thị D', age: 21, phone: '0901234567', email: 'd@example.com' },
        { id: 5, name: 'Phạm Minh E', age: 23, phone: '0967654321', email: 'e@example.com' },
        { id: 6, name: 'Vũ Thị F', age: 24, phone: '0932345678', email: 'f@example.com' },
        { id: 7, name: 'Lý Quang G', age: 26, phone: '0922334455', email: 'g@example.com' },
        { id: 8, name: 'Ngô Thị H', age: 28, phone: '0944556677', email: 'h@example.com' },
        { id: 9, name: 'Đặng Văn I', age: 30, phone: '0933445566', email: 'i@example.com' },
        { id: 10, name: 'Bùi Thị J', age: 22, phone: '0922333444', email: 'j@example.com' },
        { id: 11, name: 'Dương Thị K', age: 27, phone: '0911223344', email: 'k@example.com' },
        { id: 12, name: 'Phạm Minh L', age: 24, phone: '0912345678', email: 'l@example.com' },
        { id: 13, name: 'Trương Quang M', age: 23, phone: '0922334455', email: 'm@example.com' },
        { id: 14, name: 'Lê Thị N', age: 21, phone: '0901234567', email: 'n@example.com' },
        { id: 15, name: 'Nguyễn Thị O', age: 22, phone: '0912345678', email: 'o@example.com' },
        { id: 16, name: 'Bùi Văn P', age: 24, phone: '0922333444', email: 'p@example.com' },
        { id: 17, name: 'Vũ Thị Q', age: 23, phone: '0933445566', email: 'q@example.com' },
        { id: 18, name: 'Ngô Quang R', age: 25, phone: '0967654321', email: 'r@example.com' },
        { id: 19, name: 'Phan Quỳnh S', age: 26, phone: '0901234567', email: 's@example.com' },
        { id: 20, name: 'Lý Thị T', age: 27, phone: '0932334455', email: 't@example.com' },
        { id: 21, name: 'Trần Quang U', age: 28, phone: '0944556677', email: 'u@example.com' },
        { id: 22, name: 'Đặng Thị V', age: 29, phone: '0966123456', email: 'v@example.com' },
        { id: 23, name: 'Nguyễn Quỳnh W', age: 30, phone: '0922334455', email: 'w@example.com' },
        { id: 24, name: 'Bùi Minh X', age: 31, phone: '0912345678', email: 'x@example.com' },
        { id: 25, name: 'Vũ Thành Y', age: 32, phone: '0901234567', email: 'y@example.com' },
        { id: 26, name: 'Lê Quang Z', age: 33, phone: '0922334455', email: 'z@example.com' },
        { id: 27, name: 'Trương Thị AA', age: 34, phone: '0933445566', email: 'aa@example.com' },
        { id: 28, name: 'Ngô Văn AB', age: 20, phone: '0967654321', email: 'ab@example.com' },
        { id: 29, name: 'Phan Thị AC', age: 22, phone: '0901234567', email: 'ac@example.com' },
        { id: 30, name: 'Lý Quỳnh AD', age: 24, phone: '0922334455', email: 'ad@example.com' },
        { id: 31, name: 'Bùi Quang AE', age: 26, phone: '0944556677', email: 'ae@example.com' },
        { id: 32, name: 'Nguyễn Quỳnh AF', age: 28, phone: '0966123456', email: 'af@example.com' },
        { id: 33, name: 'Trương Minh AG', age: 30, phone: '0932334455', email: 'ag@example.com' },
        { id: 34, name: 'Lê Thành AH', age: 32, phone: '0901234567', email: 'ah@example.com' },
        { id: 35, name: 'Vũ Minh AI', age: 34, phone: '0912345678', email: 'ai@example.com' },
      ],
    },
    2: {
      name: 'Lớp học Toán',
      members: 40,
      lessons: [
        { id: 1, title: 'Phép cộng cơ bản', description: 'Học phép cộng và phép trừ cơ bản' },
        { id: 2, title: 'Phép nhân', description: 'Học cách nhân số' },
        { id: 3, title: 'Phép chia', description: 'Học phép chia đơn giản' },
        { id: 4, title: 'Giải phương trình bậc 1', description: 'Giải các phương trình bậc 1' },
        { id: 5, title: 'Giải phương trình bậc 2', description: 'Giải các phương trình bậc 2' },
        { id: 6, title: 'Hàm số', description: 'Tìm hiểu về hàm số và đồ thị' },
      ],
      membersDetail: [
        { id: 1, name: 'Hoàng Văn D', age: 21, phone: '0912345678', email: 'd@example.com' },
        { id: 2, name: 'Phạm Thị E', age: 23, phone: '0976543210', email: 'e@example.com' },
        { id: 3, name: 'Ngô Văn F', age: 26, phone: '0102030405', email: 'f@example.com' },
        { id: 4, name: 'Trương Quang G', age: 22, phone: '0922334455', email: 'g@example.com' },
        { id: 5, name: 'Lê Thị H', age: 24, phone: '0912233445', email: 'h@example.com' },
        { id: 6, name: 'Vũ Quang I', age: 27, phone: '0944556677', email: 'i@example.com' },
        { id: 7, name: 'Nguyễn Minh J', age: 25, phone: '0988776655', email: 'j@example.com' },
        { id: 8, name: 'Bùi Quỳnh K', age: 29, phone: '0901122334', email: 'k@example.com' },
        { id: 9, name: 'Hoàng Thị L', age: 21, phone: '0913445566', email: 'l@example.com' },
        { id: 10, name: 'Phan Thị M', age: 23, phone: '0966123456', email: 'm@example.com' },
        { id: 11, name: 'Nguyễn Thành N', age: 28, phone: '0922334455', email: 'n@example.com' },
        { id: 12, name: 'Dương Thị O', age: 30, phone: '0912233445', email: 'o@example.com' },
        { id: 13, name: 'Lý Quang P', age: 22, phone: '0922334455', email: 'p@example.com' },
        { id: 14, name: 'Trương Minh Q', age: 24, phone: '0901234567', email: 'q@example.com' },
        { id: 15, name: 'Bùi Thị R', age: 26, phone: '0933445566', email: 'r@example.com' },
        { id: 16, name: 'Vũ Quỳnh S', age: 28, phone: '0967654321', email: 's@example.com' },
        { id: 17, name: 'Lê Thành T', age: 30, phone: '0922334455', email: 't@example.com' },
        { id: 18, name: 'Phan Quang U', age: 32, phone: '0912345678', email: 'u@example.com' },
        { id: 19, name: 'Nguyễn Quỳnh V', age: 34, phone: '0901122334', email: 'v@example.com' },
        { id: 20, name: 'Trương Minh W', age: 36, phone: '0933445566', email: 'w@example.com' },
        { id: 21, name: 'Lý Thị X', age: 28, phone: '0922334455', email: 'x@example.com' },
        { id: 22, name: 'Ngô Thị Y', age: 29, phone: '0901234567', email: 'y@example.com' },
        { id: 23, name: 'Bùi Quỳnh Z', age: 30, phone: '0966123456', email: 'z@example.com' },
        { id: 24, name: 'Trương Thị AA', age: 31, phone: '0912233445', email: 'aa@example.com' },
        { id: 25, name: 'Nguyễn Minh AB', age: 32, phone: '0901234567', email: 'ab@example.com' },
        { id: 26, name: 'Lý Quang AC', age: 33, phone: '0933445566', email: 'ac@example.com' },
        { id: 27, name: 'Vũ Thị AD', age: 34, phone: '0922334455', email: 'ad@example.com' },
        { id: 28, name: 'Phan Thị AE', age: 36, phone: '0901234567', email: 'ae@example.com' },
        { id: 29, name: 'Trương Thị AF', age: 37, phone: '0922334455', email: 'af@example.com' },
        { id: 30, name: 'Lý Quang AG', age: 38, phone: '0912233445', email: 'ag@example.com' },
        { id: 31, name: 'Vũ Quỳnh AH', age: 39, phone: '0933445566', email: 'ah@example.com' },
        { id: 32, name: 'Nguyễn Minh AI', age: 40, phone: '0901234567', email: 'ai@example.com' },
        { id: 33, name: 'Bùi Thị AJ', age: 41, phone: '0922334455', email: 'aj@example.com' },
        { id: 34, name: 'Trương Minh AK', age: 42, phone: '0933445566', email: 'ak@example.com' },
        { id: 35, name: 'Nguyễn Thị AL', age: 43, phone: '0912233445', email: 'al@example.com' },
        { id: 36, name: 'Lý Quỳnh AM', age: 44, phone: '0901234567', email: 'am@example.com' },
        { id: 37, name: 'Phan Minh AN', age: 45, phone: '0922334455', email: 'an@example.com' },
        { id: 38, name: 'Trương Thị AO', age: 46, phone: '0933445566', email: 'ao@example.com' },
        { id: 39, name: 'Nguyễn Minh AP', age: 47, phone: '0922334455', email: 'ap@example.com' },
        { id: 40, name: 'Vũ Quỳnh AQ', age: 48, phone: '0901234567', email: 'aq@example.com' },
      ],
    },
  };

  const classInfo = classData[classId];

  
  return (
    <Box sx={{ padding: 3 }}>
      <Grid container spacing={3}>
        <Grid item xs={12}>
          <Typography variant="h4">{classInfo.name}</Typography>
          <Typography variant="body1">Số lượng thành viên: {classInfo.members}</Typography>
          {/* Nút thêm sinh viên */}
          <Box sx={{ marginTop: 3 }}>
            <Button variant="contained" onClick={() => document.getElementById('addStudentForm').style.display = 'block'}>
              Thêm sinh viên
            </Button>
            {/* Hiển thị form thêm sinh viên khi ấn "Thêm sinh viên" */}
          <Box sx={{ marginTop: 3 }} id="addStudentForm" style={{ display: 'none' }}>
            <Typography variant="h6">Nhập thông tin sinh viên</Typography>
            <TableContainer component={Paper}>
              <Table>
                <TableHead>
                  <TableRow>
                    <TableCell>Username</TableCell>

                  </TableRow>
                </TableHead>
                <TableBody>
                  {/* Chỉ hiển thị một dòng trống để nhập thông tin */}
                  <TableRow>
                    <TableCell>
                      <TextField
                        label="Username"
                        fullWidth
                      />
                    </TableCell>
                    {/* <TableCell>
                      <TextField
                        label="Tuổi"
                        fullWidth
                      />
                    </TableCell>
                    <TableCell>
                      <TextField
                        label="Số điện thoại"
                        fullWidth
                      />
                    </TableCell>
                    <TableCell>
                      <TextField
                        label="Email"
                        fullWidth
                      />
                    </TableCell> */}
                  </TableRow>
                </TableBody>
              </Table>
            </TableContainer>
            {/* Nút Cancel để quay lại màn hình cũ */}
            <Box sx={{ marginTop: 3 }}>
              <Button variant="outlined" onClick={() => document.getElementById('addStudentForm').style.display = 'none'}>
                Hủy
              </Button>
              <Button variant="outlined" onClick={() => document.getElementById('addStudentForm').style.display = 'none'}>
                Thêm sinh viên
              </Button>
            </Box>
          </Box>
          </Box>
        </Grid>
        <Grid item xs={12} md={9}>
          <Box sx={{ marginTop: 3 }}>
            {/* Hiển thị danh sách bài học */}
            <LessonList lessons={classInfo.lessons} />
          </Box>

          <Box sx={{ marginTop: 3 }}>
            {/* Hiển thị danh sách thành viên */}
            <Typography variant="h6">Danh sách thành viên</Typography>
            <TableContainer component={Paper}>
              <Table>
                <TableHead>
                  <TableRow>
                    <TableCell>Họ tên</TableCell>
                    <TableCell>Tuổi</TableCell>
                    <TableCell>SĐT</TableCell>
                    <TableCell>Email</TableCell>
                  </TableRow>
                </TableHead>
                <TableBody>
                  {classInfo.membersDetail.map((member) => (
                    <TableRow key={member.id}>
                      <TableCell>{member.name}</TableCell>
                      <TableCell>{member.age}</TableCell>
                      <TableCell>{member.phone}</TableCell>
                      <TableCell>{member.email}</TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </TableContainer>
          </Box>

          

          
        </Grid>

        <Grid item xs={12} md={3}>
          <Paper elevation={3} sx={{ padding: 2 }}>
            <Typography variant="h6">Thông tin thêm</Typography>
            <Typography variant="body2">ID lớp: {classId}</Typography>
          </Paper>
        </Grid>
      </Grid>
    </Box>
  );
};
export default ClassDetail;
