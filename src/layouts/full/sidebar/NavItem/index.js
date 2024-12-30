import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';
// Import các thành phần từ Material-UI
import {
  ListItemIcon, // Biểu tượng hiển thị bên trái của danh sách
  ListItem,     // Thành phần từng item trong danh sách
  List,         // Thành phần danh sách tổng thể
  styled,       // Công cụ tùy chỉnh CSS-in-JS
  ListItemText, // Văn bản hiển thị bên phải của item
  useTheme,     // Hook để truy cập theme Material-UI
} from '@mui/material';

// Component NavItem để hiển thị từng mục điều hướng trong sidebar/menu
const NavItem = ({ item, level, pathDirect, onClick }) => {
  const Icon = item.icon; // Biểu tượng của từng item, truyền từ props
  const theme = useTheme(); // Lấy theme của Material-UI để sử dụng các giá trị theme
  const itemIcon = <Icon stroke={1.5} size="1.3rem" />; // Biểu tượng của item, sử dụng các thuộc tính để tùy chỉnh kích thước

  // Tùy chỉnh CSS cho ListItem sử dụng styled API của Material-UI
  const ListItemStyled = styled(ListItem)(() => ({
    whiteSpace: 'nowrap', // Đảm bảo không xuống dòng
    marginBottom: '2px', // Khoảng cách giữa các item
    padding: '8px 10px', // Padding bên trong item
    borderRadius: '8px', // Bo góc cho item
    backgroundColor: level > 1 ? 'transparent !important' : 'inherit', // Nếu level > 1 thì background trong suốt
    color: theme.palette.text.secondary, // Màu chữ mặc định
    paddingLeft: '10px', // Khoảng cách từ bên trái
    '&:hover': {
      backgroundColor: theme.palette.primary.light, // Background khi hover
      color: theme.palette.primary.main, // Màu chữ khi hover
    },
    '&.Mui-selected': { // Style áp dụng khi item được chọn
      color: 'white', // Màu chữ
      backgroundColor: theme.palette.primary.main, // Background
      '&:hover': { // Khi hover trên item đã được chọn
        backgroundColor: theme.palette.primary.main,
        color: 'white',
      },
    },
  }));

  return (
    // Sử dụng List từ Material-UI để nhóm các ListItem
    <List component="li" disablePadding key={item.id}>
      {/* Sử dụng ListItemStyled với các tùy chọn từ props */}
      <ListItemStyled
        button // Cho phép click vào item
        component={item.external ? 'a' : NavLink} // Nếu item là external link, sử dụng thẻ <a>; nếu không, sử dụng NavLink
        to={item.href} // Đường dẫn của NavLink
        href={item.external ? item.href : ''} // Nếu external, thêm thuộc tính href
        disabled={item.disabled} // Disable item nếu được chỉ định
        selected={pathDirect === item.href} // Kiểm tra nếu đường dẫn hiện tại khớp với href thì chọn
        target={item.external ? '_blank' : ''} // Nếu external, mở liên kết trong tab mới
        onClick={onClick} // Xử lý sự kiện khi click vào item
      >
        {/* ListItemIcon hiển thị biểu tượng ở bên trái */}
        <ListItemIcon
          sx={{
            minWidth: '36px', // Kích thước tối thiểu của phần chứa biểu tượng
            p: '3px 0', // Padding trên và dưới
            color: 'inherit', // Kế thừa màu sắc
          }}
        >
          {itemIcon} {/* Biểu tượng được hiển thị */}
        </ListItemIcon>
        {/* ListItemText hiển thị văn bản mô tả của item */}
        <ListItemText>
          <>{item.title}</> {/* Văn bản tiêu đề của item */}
        </ListItemText>
      </ListItemStyled>
    </List>
  );
};

// Xác định kiểu dữ liệu cho các props
NavItem.propTypes = {
  item: PropTypes.object, // Đối tượng chứa thông tin về item (icon, title, href, v.v.)
  level: PropTypes.number, // Cấp độ của item (nếu dùng để tạo menu đa cấp)
  pathDirect: PropTypes.any, // Đường dẫn hiện tại, dùng để xác định item nào được chọn
  onClick: PropTypes.func, // Hàm xử lý sự kiện khi click vào item
};

export default NavItem; // Xuất component NavItem để sử dụng ở nơi khác
