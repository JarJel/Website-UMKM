import {
  Users, BookOpen, Award, Target, Star,
  Heart, Sparkles, ClipboardCheck, CheckCircle, FileText, School,
  GraduationCap, Notebook, Globe, Phone, Mail, MapPin
} from "lucide-react";

export const getIcon = (iconName, color = "#fff") => {
  const icons = {
    Users: <Users className="w-8 h-8" style={{ color }} />,
    BookOpen: <BookOpen className="w-8 h-8" style={{ color }} />,
    Award: <Award className="w-8 h-8" style={{ color }} />,
    Target: <Target className="w-8 h-8" style={{ color }} />,
    Star: <Star className="w-8 h-8" style={{ color }} />,
    Heart: <Heart className="w-8 h-8" style={{ color }} />,
    Sparkles: <Sparkles className="w-8 h-8" style={{ color }} />,
    ClipboardCheck: <ClipboardCheck className="w-8 h-8" style={{ color }} />,
    CheckCircle: <CheckCircle className="w-8 h-8" style={{ color }} />,
    FileText: <FileText className="w-8 h-8" style={{ color }} />,
    School: <School className="w-8 h-8" style={{ color }} />,
    GraduationCap: <GraduationCap className="w-8 h-8" style={{ color }} />,
    Notebook: <Notebook className="w-8 h-8" style={{ color }} />,
    Globe: <Globe className="w-8 h-8" style={{ color }} />,
    Phone: <Phone className="w-8 h-8" style={{ color }} />,
    Mail: <Mail className="w-8 h-8" style={{ color }} />,
    MapPin: <MapPin className="w-8 h-8" style={{ color }} />,
  };
  return icons[iconName] || <Star className="w-8 h-8" style={{ color }} />;
};
