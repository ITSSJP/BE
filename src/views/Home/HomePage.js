import { Grid, Box, Card, CardContent, Typography } from '@mui/material';
import PageContainer from '../../components/container/PageContainer';

// Components for HomePage
import WelcomeCard from '../../components/home/WelcomeCard';
import RecentActivities from '../../components/home/RecentActivities';
import QuickLinks from '../../components/home/QuickLink';

const KanjiHint = () => {
  // Dữ liệu Kanji mẫu
  const kanjiHints = [
    { kanji: '猫', meaning: 'Con mèo', reading: 'ねこ (neko)' },
    { kanji: '犬', meaning: 'Con chó', reading: 'いぬ (inu)' },
    { kanji: '山', meaning: 'Ngọn núi', reading: 'やま (yama)' },
    { kanji: '海', meaning: 'Biển', reading: 'うみ (umi)' },
    { kanji: '車', meaning: 'Xe hơi', reading: 'くるま (kuruma)' },
  ];

  // Lấy ngẫu nhiên một từ Kanji
  const randomIndex = Math.floor(Math.random() * kanjiHints.length);
  const todayKanji = kanjiHints[randomIndex];

  return (
    <Card>
      <CardContent>
        <Typography variant="h6" gutterBottom>
          Gợi ý từ Kanji hôm nay
        </Typography>
        <Typography variant="h4" color="primary" gutterBottom>
          {todayKanji.kanji}
        </Typography>
        <Typography variant="subtitle1">
          Cách đọc: {todayKanji.reading}
        </Typography>
        <Typography variant="body1">
          Ý nghĩa: {todayKanji.meaning}
        </Typography>
      </CardContent>
    </Card>
  );
};

const HomePage = () => {
  return (
    <PageContainer>
      <Box>
        <Grid container spacing={3}>
          <Grid item xs={12}>
            <WelcomeCard />
          </Grid>
          <Grid item xs={12} lg={8}>
            <RecentActivities />
          </Grid>
          <Grid item xs={12} lg={4}>
            <QuickLinks />
          </Grid>
          <Grid item xs={12}>
            <KanjiHint />
          </Grid>
        </Grid>
      </Box>
    </PageContainer>
  );
};

export default HomePage;
