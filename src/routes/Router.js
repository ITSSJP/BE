import  { lazy } from 'react';
import { Navigate } from 'react-router-dom';
import Loadable from '../layouts/full/shared/loadable/Loadable';

/* ***Layouts**** */
const FullLayout = Loadable(lazy(() => import('../layouts/full/FullLayout')));
const BlankLayout = Loadable(lazy(() => import('../layouts/blank/BlankLayout')));

/* ****Pages***** */
const Dashboard = Loadable(lazy(() => import('../views/dashboard/Dashboard')))



const SamplePage = Loadable(lazy(() => import('../views/sample-page/SamplePage')))
const Icons = Loadable(lazy(() => import('../views/icons/Icons')))
const TypographyPage = Loadable(lazy(() => import('../views/utilities/TypographyPage')))
const Shadow = Loadable(lazy(() => import('../views/utilities/Shadow')))
const Error = Loadable(lazy(() => import('../views/authentication/Error')));
const Register = Loadable(lazy(() => import('../views/authentication/Register')));
const Login = Loadable(lazy(() => import('../views/authentication/Login')));

/* ****New Pages for Home, Class Management, and Lessons***** */
const HomePage = Loadable(lazy(() => import('../views/Home/HomePage')));
const ClassManagementPage = Loadable(lazy(() => import('../views/ClassManagement/ClassManagement')));
const LessonsPage = Loadable(lazy(() => import('../views/LessonsPage/LessonsPage')));
const DictionaryPage = Loadable(lazy(() => import('../views/Dictionary/Dictionary')));
const ClassDetailPage = Loadable(lazy(() => import('../components/classManagement/ClassDetails')));
const TranslatePage = Loadable(lazy(() => import('../views/Translate/Translate')));
const TestPage = Loadable(lazy(() => import('../views/test/Test')));


const Router = [
  {
    path: '/',
    element: <FullLayout />,
    children: [
      { path: '/', element: <Navigate to="/dashboard" /> },
      { path: '/dashboard', exact: true, element: <Dashboard /> },
      { path: '/sample-page', exact: true, element: <SamplePage /> },
      { path: '/icons', exact: true, element: <Icons /> },
      { path: '/ui/typography', exact: true, element: <TypographyPage /> },
      { path: '/ui/shadow', exact: true, element: <Shadow /> },
      { path: '*', element: <Navigate to="/auth/404" /> },
      { path: '/home', exact: true, element: <HomePage /> }, // Home
      { path: '/class-management', exact: true, element: <ClassManagementPage /> }, // Quản lý lớp học
      { path: '/lessons', exact: true, element: <LessonsPage /> }, // Bài học
      { path: '/dictionary', exact: true, element: <DictionaryPage /> },
      { path: '/translate', exact: true, element: <TranslatePage /> },
      { path: '/test', exact: true, element: <TestPage /> },
      { path: '/class/:classId', exact: true, element: <ClassDetailPage /> }, // Trang chi tiết lớp


      // eslint-disable-next-line react/jsx-no-undef


      { path: '*', element: <Navigate to="/auth/404" /> },
    ],
  },
  {
    path: '/auth',
    element: <BlankLayout />,
    children: [
      { path: '404', element: <Error /> },
      { path: '/auth/register', element: <Register /> },
      { path: '/auth/login', element: <Login /> },
      { path: '*', element: <Navigate to="/auth/404" /> },
    ],
  },
];

export default Router;
