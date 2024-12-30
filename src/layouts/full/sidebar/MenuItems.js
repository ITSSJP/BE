import {
  IconAperture, IconCopy, IconLayoutDashboard, IconLogin, IconMoodHappy, IconTypography, IconUserPlus,IconHome,IconSchool,IconBook
} from '@tabler/icons-react';
import { SiDictionarydotcom,SiRoamresearch } from "react-icons/si";


import { uniqueId } from 'lodash';

const Menuitems = [
  {
    navlabel: true,
    subheader: 'Home',
  },
  {
    id: uniqueId(),
    title: 'Home', // Tên mục
    icon: IconHome, // Biểu tượng
    href: '/home', // Đường dẫn
  },
  {
    id: uniqueId(),
    title: 'Dashboard',
    icon: IconLayoutDashboard,
    href: '/dashboard',
  },
  {
    navlabel: true,
    subheader: 'Quản lý',
  },
  {
    id: uniqueId(),
    title: 'Quản lý lớp học', // Tên mục
    icon: IconSchool, // Biểu tượng
    href: '/class-management', // Đường dẫn
  },

  {
    id: uniqueId(),
    title:'Từ Điển',
    icon: SiDictionarydotcom,
    href:'/dictionary'
  },
  {
    id: uniqueId(),
    title:'Dịch',
    icon: SiRoamresearch,
    href:'/translate'
  },
  {
    navlabel: true,
    subheader: 'Navigate',
  },
  {
    id: uniqueId(),
    title:'Test',
    icon: SiRoamresearch,
    href:'/test'
  },  {
    id: uniqueId(),
    title:'Chi tiết lớp học',
    icon: SiRoamresearch,
    href:'/classdetail'
  },
  {
    id: uniqueId(),
    title: 'Bài học', // Tên mục
    icon: IconBook, // Biểu tượng
    href: '/lessons', // Đường dẫn
  },
  {
    navlabel: true,
    subheader: 'Utilities',
  },
  {
    id: uniqueId(),
    title: 'Typography',
    icon: IconTypography,
    href: '/ui/typography',
  },
  {
    id: uniqueId(),
    title: 'Shadow',
    icon: IconCopy,
    href: '/ui/shadow',
  },
  {
    navlabel: true,
    subheader: 'Auth',
  },
  {
    id: uniqueId(),
    title: 'Login',
    icon: IconLogin,
    href: '/auth/login',
  },
  {
    id: uniqueId(),
    title: 'Register',
    icon: IconUserPlus,
    href: '/auth/register',
  },
  {
    navlabel: true,
    subheader: 'Extra',
  },
  {
    id: uniqueId(),
    title: 'Icons',
    icon: IconMoodHappy,
    href: '/icons',
  },
  {
    id: uniqueId(),
    title: 'Sample Page',
    icon: IconAperture,
    href: '/sample-page',
  },
];

export default Menuitems;
